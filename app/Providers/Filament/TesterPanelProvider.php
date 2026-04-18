<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
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
use Hammadzafar05\MobileBottomNav\MobileBottomNav;
use Hammadzafar05\MobileBottomNav\MobileBottomNavItem;
use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\Register;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;

class TesterPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('tester')
            ->path('tester')
            ->brandName('PlayTest ID')
            ->registration(Register::class)
            ->passwordReset(RequestResetPassword::class, ResetPassword::class)
            ->colors([
                'primary' => Color::Indigo,
            ])
            //Ini berfungsi untuk ketika masuk mode mobile dia navbarnya jadi ganti
            ->plugins([
                MobileBottomNav::make()
                    ->items([
                        MobileBottomNavItem::make('Home')
                            ->icon('heroicon-o-home')
                            ->activeIcon('heroicon-s-home')
                            ->url('/tester')
                            ->isActive(fn() => request()->is('tester')),
                        MobileBottomNavItem::make('Inbox')
                            ->icon('heroicon-o-inbox')
                            ->url('/tester/inbox')
                            ->badge(5, 'danger'),
                        MobileBottomNavItem::make('Profile')
                            ->icon('heroicon-o-user')
                            ->url('/tester/profile'),
                    ]),
            ])
            ->login(Login::class)
            ->discoverResources(in: app_path('Filament/Tester/Resources'), for: 'App\Filament\Tester\Resources')
            ->discoverPages(in: app_path('Filament/Tester/Pages'), for: 'App\Filament\Tester\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Tester/Widgets'), for: 'App\Filament\Tester\Widgets')
            ->widgets([
                AccountWidget::class,
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
