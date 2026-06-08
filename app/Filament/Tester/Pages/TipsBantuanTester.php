<?php

namespace App\Filament\Tester\Pages;

use Filament\Pages\Page;

class TipsBantuanTester extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-question-mark-circle';
    
    public static function getNavigationLabel(): string
    {
        return __('Tips & Bantuan');
    }

    public function getTitle(): string
    {
        return __('Tips & Bantuan');
    }

    protected static ?string $slug = 'tips-bantuan';
    protected static ?int $navigationSort = 99;
    protected static bool $shouldRegisterNavigation = false;
    protected string $view = 'filament.tester.pages.tips-bantuan-tester';
}
