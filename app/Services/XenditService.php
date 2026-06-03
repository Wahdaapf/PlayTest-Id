<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class XenditService
{
    protected string $secretKey;
    protected string $baseUrl = 'https://api.xendit.co';

    public function __construct()
    {
        $this->secretKey = config('services.xendit.secret_key');
    }

    /**
     * Create a payout using Xendit Payouts V2 API
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function createPayout(array $data): array
    {
        $idempotencyKey = 'wd_payout_' . ($data['reference_id'] ?? uniqid());

        $response = Http::withHeaders([
            'Idempotency-key' => $idempotencyKey,
            'Content-Type' => 'application/json',
        ])
        ->withBasicAuth($this->secretKey, '')
        ->post("{$this->baseUrl}/v2/payouts", [
            'reference_id' => $data['reference_id'],
            'channel_code' => $data['channel_code'],
            'channel_properties' => [
                'account_number' => $data['account_number'],
                'account_holder_name' => $data['account_holder_name'],
            ],
            'amount' => (float) $data['amount'],
            'description' => $data['description'] ?? 'Withdrawal PlayTest ID',
            'currency' => 'IDR',
        ]);

        if ($response->failed()) {
            Log::error('Xendit Payout Creation Failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'payload' => $data,
            ]);

            $message = $response->json('message') ?? $response->json('error_code') ?? 'Failed to create payout in Xendit.';
            throw new \Exception($message);
        }

        return $response->json();
    }

    /**
     * Get payout details from Xendit
     *
     * @param string $payoutId
     * @return array
     * @throws \Exception
     */
    public function getPayout(string $payoutId): array
    {
        $response = Http::withBasicAuth($this->secretKey, '')
            ->get("{$this->baseUrl}/v2/payouts/{$payoutId}");

        if ($response->failed()) {
            Log::error('Xendit Get Payout Failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'payout_id' => $payoutId,
            ]);

            $message = $response->json('message') ?? $response->json('error_code') ?? 'Failed to fetch payout status from Xendit.';
            throw new \Exception($message);
        }

        return $response->json();
    }
}
