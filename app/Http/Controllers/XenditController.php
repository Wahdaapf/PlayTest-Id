<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class XenditController extends Controller
{
    /**
     * Handle Xendit Payout / Disbursement callback webhook
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function payoutCallback(Request $request)
    {
        Log::info('Xendit Payout Webhook Received', [
            'headers' => $request->headers->all(),
            'payload' => $request->all(),
        ]);

        // Verify callback token if configured
        $configuredToken = config('services.xendit.callback_token');
        $callbackToken = $request->header('x-callback-token');

        if ($configuredToken && $callbackToken !== $configuredToken) {
            Log::warning('Xendit Callback Token Mismatch', [
                'received' => $callbackToken,
            ]);
            return response('Invalid Callback Token', 401);
        }

        // Handle both Payouts V2 webhook and Legacy Disbursements webhook formats
        $referenceId = null;
        $status = null;
        $payoutId = null;
        $failureCode = null;

        if ($request->has('event') && $request->has('data')) {
            // Payouts V2 Webhook Format
            $data = $request->input('data');
            $referenceId = $data['reference_id'] ?? null;
            $status = strtoupper($data['status'] ?? '');
            $payoutId = $data['id'] ?? $data['payout_id'] ?? null;
            $failureCode = $data['failure_code'] ?? null;
        } else {
            // Legacy/alternative format
            $referenceId = $request->input('external_id') ?? $request->input('reference_id');
            $status = strtoupper($request->input('status') ?? '');
            $payoutId = $request->input('id') ?? $request->input('payout_id');
            $failureCode = $request->input('failure_code') ?? $request->input('failure_reason');
        }

        if (!$referenceId) {
            Log::error('Xendit Webhook missing reference ID', ['payload' => $request->all()]);
            return response('Missing reference ID', 400);
        }

        // Extract internal withdraw ID from reference format (e.g., "WD-YYYYMMDD-ID")
        $parts = explode('-', $referenceId);
        $withdrawId = end($parts);

        $withdraw = Withdraw::find($withdrawId);
        if (!$withdraw) {
            Log::error('Xendit Webhook: Withdrawal record not found', [
                'reference_id' => $referenceId,
                'extracted_id' => $withdrawId,
            ]);
            return response('Withdrawal not found', 404);
        }

        // Avoid processing if already resolved
        if ($withdraw->status !== 'pending') {
            Log::info('Xendit Webhook: Withdrawal already processed', [
                'withdraw_id' => $withdraw->id,
                'current_status' => $withdraw->status,
            ]);
            return response('Already processed', 200);
        }

        try {
            if ($status === 'COMPLETED' || $status === 'SUCCEEDED') {
                $withdraw->update([
                    'status'           => 'success',
                    'xendit_payout_id' => $payoutId,
                    'catatan'          => 'Withdrawal completed via Xendit webhook callback.',
                ]);
                Log::info('Xendit Payout Success Webhook processed', ['withdraw_id' => $withdraw->id]);
            } elseif ($status === 'FAILED' || $status === 'REJECTED') {
                DB::transaction(function () use ($withdraw, $payoutId, $failureCode) {
                    $balance = UserBalance::where('id_user', $withdraw->id_user)->first();
                    if ($balance) {
                        $balance->increment('point', $withdraw->point);
                    }
                    $withdraw->update([
                        'status'           => 'rejected',
                        'xendit_payout_id' => $payoutId,
                        'catatan'          => 'Xendit payout failed via webhook: ' . ($failureCode ?? 'Unknown Reason'),
                    ]);
                });
                Log::info('Xendit Payout Failed Webhook processed. Points refunded.', ['withdraw_id' => $withdraw->id]);
            } else {
                Log::info('Xendit Webhook: status unchanged', ['status' => $status]);
            }

            return response('OK', 200);
        } catch (\Exception $e) {
            Log::error('Error processing Xendit Webhook', [
                'message' => $e->getMessage(),
                'withdraw_id' => $withdraw->id,
            ]);
            return response('Internal Server Error', 500);
        }
    }
}
