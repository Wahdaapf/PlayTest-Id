<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Models\Pembayaran;
use App\Models\Paket;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;

class CreateMisi extends CreateRecord
{
    protected static string $resource = MisiResource::class;
    protected static ?string $activeNavigationItem = 'New Test Case';

    protected ?string $paymentUrl = null;
    protected ?string $paymentMethodCode = 'VC';

    public function getTitle(): string
    {
        return 'Buat Misi Baru';
    }

    /**
     * Inject id_user dari user yang sedang login
     * sebelum data disimpan ke tabel misi.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_user'] = auth()->id();

        // Hapus field sementara pembayaran_image dari data misi
        // karena field ini tidak ada di tabel misi
        unset($data['pembayaran_image']);

        if (isset($data['payment_method'])) {
            $this->paymentMethodCode = $data['payment_method'];
            unset($data['payment_method']);
        }

        return $data;
    }

    /**
     * Setelah misi berhasil dibuat, simpan pembayaran-nya.
     */
    protected function afterCreate(): void
    {
        $misi = $this->record;
        $user = auth()->user();
        $paket = Paket::find($misi->id_paket);

        $merchantCode = config('duitku.merchant_code');
        $apiKey = config('duitku.api_key');

        $paymentAmount = (int) ($paket->price + $paket->fee);
        $merchantOrderId = 'MISI-' . $misi->id . '-' . time();
        $productDetails = "Pembayaran Paket " . $paket->name . " untuk Misi " . $misi->nama_aplikasi;
        $email = $user->email;

        $signature = md5(
            $merchantCode .
            $merchantOrderId .
            $paymentAmount .
            $apiKey
        );

        $params = [
            'merchantCode' => $merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => $this->paymentMethodCode,
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

        if ($response->successful() && isset($result['paymentUrl'])) {
            $this->paymentUrl = $result['paymentUrl'];
            
            Pembayaran::create([
                'id_misi' => $misi->id,
                'id_user' => $user->id,
                'id_paket' => $misi->id_paket,
                'status' => 'pending',
                'reference' => $merchantOrderId,
                'payment_url' => $this->paymentUrl,
            ]);
        } else {
            // Fallback if Duitku API fails
            Pembayaran::create([
                'id_misi' => $misi->id,
                'id_user' => $user->id,
                'id_paket' => $misi->id_paket,
                'status' => 'pending',
                'reference' => $merchantOrderId,
            ]);
            
            \Illuminate\Support\Facades\Log::error('Duitku API Error: ' . $response->body());
            
            $errorMessage = isset($result['returnMessage']) ? $result['returnMessage'] : $response->body();
            
            Notification::make()
                ->title('Gagal membuat link pembayaran')
                ->body('Detail: ' . substr($errorMessage, 0, 150))
                ->danger()
                ->send();
        }
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        if ($this->paymentUrl) {
            return $this->paymentUrl;
        }
        
        return $this->getResource()::getUrl('index');
    }
}