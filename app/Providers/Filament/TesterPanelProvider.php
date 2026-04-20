<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\Register;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;
use App\Filament\Tester\Pages\TesterDashboard;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Hammadzafar05\MobileBottomNav\MobileBottomNav;
use Hammadzafar05\MobileBottomNav\MobileBottomNavItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class TesterPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('tester')
            ->path('tester')
            ->login(Login::class)
            ->registration(Register::class)
            ->passwordReset(RequestResetPassword::class, ResetPassword::class)
            ->plugins([
                MobileBottomNav::make()
                    ->items([
                        MobileBottomNavItem::make('Home')
                            ->icon('heroicon-o-home')
                            ->activeIcon('heroicon-s-home')
                            ->url(fn() => TesterDashboard::getUrl())
                            ->isActive(fn() => request()->routeIs('filament.tester.pages.tester-dashboard')),
                        MobileBottomNavItem::make('Misi')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->url('#'),
                        MobileBottomNavItem::make('Dompet')
                            ->icon('heroicon-o-credit-card')
                            ->url('#'),
                        MobileBottomNavItem::make('Profil')
                            ->icon('heroicon-o-user-circle')
                            ->url('#'),
                    ]),
            ])

            // ── Warna primer: Sky/Cyan sesuai design gradient ────  
            ->colors([
                'primary' => [
                    50 => '240 249 255',   // #f0f9ff  
                    100 => '224 242 254',
                    200 => '186 230 253',
                    300 => '125 211 252',
                    400 => '56  189 248',
                    500 => '14  165 233',   // #0ea5e9  
                    600 => '2   132 199',
                    700 => '3   105 161',
                    800 => '7   89  133',
                    900 => '12  74  110',
                    950 => '8   47  73',
                ],
            ])

            // ── Sidebar Navigation ────────────────────────────  
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make('Menu')
                        ->items([
                            NavigationItem::make('Home')
                                ->icon('heroicon-o-home')
                                ->isActiveWhen(fn() => request()->routeIs('filament.tester.pages.tester-dashboard'))
                                ->url(fn() => TesterDashboard::getUrl()),

                            NavigationItem::make('Misi Saya')
                                ->icon('heroicon-o-clipboard-document-check')
                                ->badge(3)
                                ->url('#'),

                            NavigationItem::make('Dompet')
                                ->icon('heroicon-o-credit-card')
                                ->url('#'),

                            NavigationItem::make('Profil')
                                ->icon('heroicon-o-user-circle')
                                ->url('#'),
                        ]),

                    NavigationGroup::make('Lainnya')
                        ->items([
                            NavigationItem::make('Bantuan')
                                ->icon('heroicon-o-question-mark-circle')
                                ->url('#'),
                        ]),
                ]);
            })

            // ── Pages ─────────────────────────────────────────  
            ->pages([
                TesterDashboard::class,
            ])
            ->discoverPages(
                in: app_path('Filament/Tester/Pages'),
                for: 'App\\Filament\\Tester\\Pages'
            )

            // ── Assets ────────────────────────────────────────  
            ->renderHook(
                'panels::head.end',
                fn(): string => Blade::render("@vite('resources/css/app.css')"),
            )

            // ── Middleware ────────────────────────────────────  
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