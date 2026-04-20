<?php

namespace App\Filament\Developer\Resources\Pembayarans\Pages;

use App\Filament\Developer\Pages\MisiSuccess;
use App\Filament\Developer\Resources\Pembayarans\PembayaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function getRedirectUrl(): string
    {
        return MisiSuccess::getUrl();
    }

    protected function afterCreate(): void
    {
        $this->record->misi?->update([
            'status' => 'waiting',
        ]);
    }
}
