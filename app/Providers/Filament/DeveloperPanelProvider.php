<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\Register;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;
use App\Filament\Developer\Pages\DeveloperDashboard;
use App\Filament\Developer\Pages\ProfileDeveloper;
use App\Filament\Developer\Pages\PantauProgress;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Hammadzafar05\MobileBottomNav\MobileBottomNav;
use Hammadzafar05\MobileBottomNav\MobileBottomNavItem;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class DeveloperPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('developer')
            ->path('developer')
            ->login(Login::class)
            ->registration(Register::class)
            ->passwordReset(RequestResetPassword::class, ResetPassword::class)
            // ── Warna sesuai landing page (#2563eb) ──  
            ->colors([
                'primary' => [
                    50 => '239 246 255',
                    100 => '219 234 254',
                    200 => '191 219 254',
                    300 => '147 197 253',
                    400 => '96 165 250',
                    500 => '59 130 246',
                    600 => '37 99 235',
                    700 => '29 78 216',
                    800 => '30 64 175',
                    900 => '30 58 138',
                    950 => '23 37 84',
                ],
            ])
            ->navigationGroups([
                NavigationGroup::make('MAIN'),
                NavigationGroup::make('SETTINGS'),
            ])
            ->navigationItems([
                NavigationItem::make('New Test Case')
                    ->icon('heroicon-o-document-plus')
                    ->group('MAIN')
                    ->url(fn(): string => \App\Filament\Developer\Resources\Misis\MisiResource::getUrl('create'))
                    ->isActiveWhen(fn() => request()->routeIs('filament.developer.resources.misis.create'))
                    ->sort(3),
                NavigationItem::make('Pantau Progress')
                    ->icon('heroicon-o-chart-bar')
                    ->group('MAIN')
                    ->url(fn(): string => PantauProgress::getUrl())
                    ->isActiveWhen(fn() => request()->routeIs('filament.developer.pages.pantau-progress'))
                    ->sort(2),
                NavigationItem::make('Profil Saya')
                    ->icon('heroicon-o-user-circle')
                    ->group('SETTINGS')
                    ->url(fn(): string => ProfileDeveloper::getUrl())
                    ->isActiveWhen(fn() => request()->routeIs('filament.developer.pages.profile-developer'))
                    ->sort(1),
                NavigationItem::make('Settings')
                    ->icon('heroicon-o-cog-8-tooth')
                    ->group('SETTINGS')
                    ->url('#')
                    ->sort(2),
                NavigationItem::make('Support')
                    ->icon('heroicon-o-lifebuoy')
                    ->group('SETTINGS')
                    ->url('#')
                    ->sort(3),
            ])
            ->plugins([
                MobileBottomNav::make()
                    ->items([
                        MobileBottomNavItem::make('Home')
                            ->icon('heroicon-o-home')
                            ->activeIcon('heroicon-s-home')
                            ->url('/developer')
                            ->isActive(fn() => request()->is('developer')),
                        MobileBottomNavItem::make('Inbox')
                            ->icon('heroicon-o-inbox')
                            ->url('/developer/inbox')
                            ->badge(5, 'danger'),
                        MobileBottomNavItem::make('Profile')
                            ->icon('heroicon-o-user')
                            ->activeIcon('heroicon-s-user')
                            ->url(fn() => ProfileDeveloper::getUrl())
                            ->isActive(fn() => request()->routeIs('filament.developer.pages.profile-developer')),
                    ]),
            ])

            ->renderHook(
                'panels::head.end',
                fn(): string => Blade::render("@vite(['resources/css/app.css', 'resources/css/filament-sidebar.css', 'resources/css/filament-topbar.css'])"),
            )

            ->pages([
                DeveloperDashboard::class,
                PantauProgress::class,
            ])
            ->discoverPages(
                in: app_path('Filament/Developer/Pages'),
                for: 'App\\Filament\\Developer\\Pages'
            )
            ->discoverResources(
                in: app_path('Filament/Developer/Resources'),
                for: 'App\\Filament\\Developer\\Resources'
            )
            ->discoverWidgets(
                in: app_path('Filament/Developer/Widgets'),
                for: 'App\\Filament\\Developer\\Widgets'
            )
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

