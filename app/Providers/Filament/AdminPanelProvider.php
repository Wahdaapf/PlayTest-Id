<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Admin\Pages\AdminDashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Blade;
use Filament\Navigation\NavigationItem;
use Hammadzafar05\MobileBottomNav\MobileBottomNav;
use Hammadzafar05\MobileBottomNav\MobileBottomNavItem;
use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('PlayTest ID')
            ->passwordReset(RequestResetPassword::class, ResetPassword::class)
            ->login(Login::class)
            ->colors([
                'primary' => Color::Indigo,
            ])
            //Ini berfungsi untuk ketika masuk mode mobile dia navbarnya jadi ganti ke bawah
            //Icon dari https://heroicons.com/
            ->plugins([
                MobileBottomNav::make()
                    ->items([
                        MobileBottomNavItem::make('Dashboard')
                            ->icon('heroicon-o-home')
                            ->activeIcon('heroicon-s-home')
                            ->url('/admin')
                            ->isActive(fn() => request()->is('admin')),
                        MobileBottomNavItem::make('Apps')
                            ->icon('heroicon-o-rocket-launch')
                            ->url('/admin/inbox')
                            ->badge(5, 'danger'),
                        MobileBottomNavItem::make('Profile')
                            ->icon('heroicon-o-user')
                            ->url('/admin/profile'),
                    ]),
            ])
            ->renderHook(
                'panels::head.end',
                fn(): string => Blade::render("@vite('resources/css/app.css')"),
            )
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\Filament\Admin\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\Filament\Admin\Pages')
            ->pages([
                AdminDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
