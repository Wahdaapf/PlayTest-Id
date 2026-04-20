<?php

namespace App\Filament\Admin\Resources\Pakets\Pages;

use App\Filament\Admin\Resources\Pakets\PaketResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPaket extends EditRecord
{
    protected static string $resource = PaketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
