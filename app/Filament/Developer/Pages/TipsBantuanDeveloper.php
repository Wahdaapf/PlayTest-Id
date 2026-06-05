<?php

namespace App\Filament\Developer\Pages;

use Filament\Pages\Page;

class TipsBantuanDeveloper extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'Tips & Bantuan';
    protected static ?string $title = 'Tips & Bantuan';
    protected static ?string $slug = 'tips-bantuan';
    protected static ?int $navigationSort = 99;
    protected static bool $shouldRegisterNavigation = false;
    protected string $view = 'filament.developer.pages.tips-bantuan-developer';
}
