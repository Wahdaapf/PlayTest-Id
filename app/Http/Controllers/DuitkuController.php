<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DuitkuController extends Controller
{
    public function createTransaction(Request $request)
    {
        $merchantCode = config('duitku.merchant_code');
        $apiKey = config('duitku.api_key');

        $paymentAmount = 10000;
        $merchantOrderId = time();
        $productDetails = "Pembelian Produk";
        $email = "user@gmail.com";

        $signature = md5(
            $merchantCode .
            $merchantOrderId .
            $paymentAmount .
            $apiKey
        );

        $params = [
            'merchantCode' => $merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => 'VC',
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'email' => $email,
            'callbackUrl' => url('/duitku/callback'),
            'returnUrl' => url('/duitku/return'),
            'signature' => $signature,
        ];

        $response = Http::post(
            config('duitku.base_url') . '/webapi/api/merchant/v2/inquiry',
            $params
        );

        $result = $response->json();

        if (isset($result['paymentUrl'])) {
            return redirect($result['paymentUrl']);
        }

        return $result;
    }

    public function callback(Request $request)
    {
        $merchantCode = config('duitku.merchant_code');
        $apiKey = config('duitku.api_key');

        $merchantOrderId = $request->merchantOrderId;
        $amount = $request->amount;
        $signature = $request->signature;

        $validSignature = md5(
            $merchantCode .
            $amount .
            $merchantOrderId .
            $apiKey
        );

        if ($signature == $validSignature) {
            $pembayaran = \App\Models\Pembayaran::where('reference', $merchantOrderId)->first();
            
            if ($pembayaran) {
                if ($request->resultCode == "00") {
                    $pembayaran->update(['status' => 'accepted']);
                    
                    $misi = \App\Models\Misi::find($pembayaran->id_misi);
                    if ($misi && in_array($misi->status, ['pending', 'waiting', 'draft'])) {
                        $misi->update(['status' => 'open']);
                    }
                } else if ($request->resultCode == "01") {
                    $pembayaran->update(['status' => 'rejected']);
                    
                    $misi = \App\Models\Misi::find($pembayaran->id_misi);
                    if ($misi) {
                        $misi->update(['status' => 'rejected']);
                    }
                }
            }

            return response('OK', 200);
        }

        return response('Invalid Signature', 400);
    }

    public function return()
    {
        return redirect()->to('/developer/misis');
    }
}