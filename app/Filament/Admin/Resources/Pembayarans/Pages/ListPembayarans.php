<?php

namespace App\Filament\Admin\Resources\Pembayarans\Pages;

use App\Filament\Admin\Resources\Pembayarans\PembayaranResource;
use Filament\Resources\Pages\ListRecords;

class ListPembayarans extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
