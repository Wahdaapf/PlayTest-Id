<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class TipsBantuan extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function getNavigationLabel(): string
    {
        return __('Tips & Bantuan');
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return __('Tips & Bantuan');
    }
    protected static ?string $slug = 'tips-bantuan';
    protected static ?int $navigationSort = 99;
    protected static bool $shouldRegisterNavigation = false;
    protected string $view = 'filament.admin.pages.tips-bantuan';
}
