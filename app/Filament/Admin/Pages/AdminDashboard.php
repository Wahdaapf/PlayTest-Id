<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class AdminDashboard extends Page
{
    protected static ?string $slug = 'dashboard';

    protected string $view = 'filament.admin.pages.admin-dashboard';
}
