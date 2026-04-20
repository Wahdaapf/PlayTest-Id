<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Filament\Developer\Resources\Pembayarans\PembayaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMisi extends CreateRecord
{
    protected static string $resource = MisiResource::class;

    protected function getRedirectUrl(): string
    {
        return PembayaranResource::getUrl('create', [
            'id_misi' => $this->record->id,
        ]);
    }
}
