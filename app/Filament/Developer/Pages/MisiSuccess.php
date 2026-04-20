<?php

namespace App\Filament\Developer\Pages;

use Filament\Pages\Page;

class MisiSuccess extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = \Filament\Support\Icons\Heroicon::CheckCircle;

    protected string $view = 'filament.developer.pages.misi-success';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Misi Berhasil Disubmit';
}
