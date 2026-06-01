<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class TipsBantuan extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'Tips & Bantuan';
    protected static ?string $title = 'Tips & Bantuan';
    protected static ?string $slug = 'tips-bantuan';
    protected static ?int $navigationSort = 99;
    protected static bool $shouldRegisterNavigation = false;
    protected string $view = 'filament.admin.pages.tips-bantuan';
}
