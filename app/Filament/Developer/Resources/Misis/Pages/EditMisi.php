<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use Filament\Resources\Pages\EditRecord;

class EditMisi extends EditRecord
{
    protected static string $resource = MisiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [];
    }
}