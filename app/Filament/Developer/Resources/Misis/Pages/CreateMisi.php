<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Models\Pembayaran;
use Filament\Resources\Pages\CreateRecord;

class CreateMisi extends CreateRecord
{
    protected static string $resource = MisiResource::class;
    protected static ?string $activeNavigationItem = 'New Test Case';

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

        return $data;
    }

    /**
     * Setelah misi berhasil dibuat, simpan pembayaran-nya.
     */
    protected function afterCreate(): void
    {
        $misi = $this->record;
        $formData = $this->data;

        Pembayaran::create([
            'id_misi' => $misi->id,
            'id_user' => auth()->id(),
            'id_paket' => $misi->id_paket,
            'image' => is_array($formData['pembayaran_image']) 
                ? array_values($formData['pembayaran_image'])[0] 
                : $formData['pembayaran_image'],
            'status' => 'pending',
        ]);
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}