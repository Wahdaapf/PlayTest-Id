<?php

namespace App\Filament\Admin\Resources\Pakets\Pages;

use App\Filament\Admin\Resources\Pakets\PaketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPakets extends ListRecords
{
    protected static string $resource = PaketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
