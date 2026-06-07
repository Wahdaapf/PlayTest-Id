<?php

namespace App\Filament\Admin\Resources\Pakets\Pages;

use App\Filament\Admin\Resources\Pakets\PaketResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaket extends CreateRecord
{
    protected static string $resource = PaketResource::class;

    protected function getRedirectUrl(): string
    {
        return '/admin/manajemen-paket';
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return __('Paket berhasil dibuat');
    }
}
