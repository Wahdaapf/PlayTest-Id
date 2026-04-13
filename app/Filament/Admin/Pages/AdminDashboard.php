<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard;

class AdminDashboard extends Dashboard
{
    protected static ?string $slug = 'dashboard';

    protected string $view = 'filament.admin.pages.admin-dashboard';
}
