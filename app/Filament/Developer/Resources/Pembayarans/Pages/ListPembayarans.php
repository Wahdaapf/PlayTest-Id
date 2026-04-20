<?php

namespace App\Filament\Developer\Resources\Pembayarans\Pages;

use App\Filament\Developer\Resources\Pembayarans\PembayaranResource;
use App\Filament\Developer\Resources\Pembayarans\Widgets\PendingMisiWidget;
use Filament\Resources\Pages\ListRecords;

class ListPembayarans extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            PendingMisiWidget::class,
        ];
    }
}
