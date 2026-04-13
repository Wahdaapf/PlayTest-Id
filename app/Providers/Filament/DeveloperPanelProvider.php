<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Developer\Pages\DeveloperDashboard;
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
class DeveloperPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('developer')
            ->path('developer')
            ->login()
            ->brandName('PlayTest ID')
            ->brandLogo(fn () => view('filament.developer.logo'))
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->renderHook(
                'panels::head.end',
                fn(): string => Blade::render("@vite('resources/css/app.css')"),
            )
            ->navigationItems([
                NavigationItem::make('My Apps')
                    ->icon('heroicon-o-squares-2x2')
                    ->url('#'),
                NavigationItem::make('New Test Case')
                    ->icon('heroicon-o-plus-circle')
                    ->url('#'),
                NavigationItem::make('Settings')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('#'),
                NavigationItem::make('Support')
                    ->icon('heroicon-o-question-mark-circle')
                    ->url('#')
                    ->sort(100),
            ])
            ->discoverResources(in: app_path('Filament/Developer/Resources'), for: 'App\Filament\Developer\Resources')
            ->discoverPages(in: app_path('Filament/Developer/Pages'), for: 'App\Filament\Developer\Pages')
            ->pages([
                DeveloperDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Developer/Widgets'), for: 'App\Filament\Developer\Widgets')
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
