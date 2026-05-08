<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;
use App\Filament\Admin\Pages\AdminDashboard;
use App\Filament\Admin\Pages\ManajemenPengguna;
use App\Filament\Admin\Pages\ManajemenKampanye;
use App\Filament\Admin\Pages\ManajemenPembayaran;
use App\Filament\Admin\Pages\ManajemenPaket;
use App\Filament\Admin\Pages\ProfileAdmin;
use App\Filament\Admin\Pages\ManajemenWithdraw;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
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

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->passwordReset(RequestResetPassword::class, ResetPassword::class)

            // ── Brand & Warna ─────────────────────────────────  
            ->colors([
                'primary' => [
                    50  => '239 246 255',   // #eff6ff  
                    100 => '219 234 254',
                    200 => '191 219 254',
                    300 => '147 197 253',
                    400 => '96  165 250',
                    500 => '59  130 246',
                    600 => '37  99  235',   // #2563eb  ← utama  
                    700 => '29  78  216',
                    800 => '30  64  175',
                    900 => '30  58  138',
                    950 => '23  37  84',
                ],
                'warning' => Color::Amber,
            ])

            // ── Sidebar Navigation ────────────────────────────  
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make('Menu Utama')
                        ->items([
                            NavigationItem::make('Dashboard')
                                ->icon('heroicon-o-squares-2x2')
                                ->isActiveWhen(fn() => request()->routeIs('filament.admin.pages.admin-dashboard'))
                                ->url(fn() => AdminDashboard::getUrl()),

                            NavigationItem::make('Pengguna')
                                ->icon('heroicon-o-users')
                                ->badge(fn() => \App\Models\User::where('role', '!=', \App\Enums\UserRole::admin)->count())
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-pengguna*'))
                                ->url(fn() => ManajemenPengguna::getUrl()),

                            NavigationItem::make('Kampanye')
                                ->icon('heroicon-o-clipboard-document-list')
                                ->badge(fn() => \App\Models\Misi::count())
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-kampanye*'))
                                ->url(fn() => ManajemenKampanye::getUrl()),

                            NavigationItem::make('Paket')
                                ->icon('heroicon-o-squares-2x2')
                                ->url(fn() => ManajemenPaket::getUrl())
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-paket*')),
                        ]),

                    NavigationGroup::make('Transaksi & Keuangan')
                        ->items([
                            NavigationItem::make('Pembayaran Developer')
                                ->icon('heroicon-o-credit-card')
                                ->badge(fn() => \App\Models\Pembayaran::where('status', 'pending')->count() ?: null)
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-pembayaran*'))
                                ->url(fn() => ManajemenPembayaran::getUrl()),

                            NavigationItem::make('Penarikan Tester')
                                ->icon('heroicon-o-banknotes')
                                ->badge(fn() => \App\Models\Withdraw::where('status', 'pending')->count() ?: null)
                                ->isActiveWhen(fn() => request()->is('admin/manajemen-withdraw*'))
                                ->url(fn() => ManajemenWithdraw::getUrl()),
                        ]),

                    NavigationGroup::make('Sistem')
                        ->items([
                            NavigationItem::make('Profil Saya')
                                ->icon('heroicon-o-user-circle')
                                ->isActiveWhen(fn() => request()->routeIs('filament.admin.pages.profile-admin'))
                                ->url(fn() => ProfileAdmin::getUrl()),

                            NavigationItem::make('Pengaturan')
                                ->icon('heroicon-o-cog-6-tooth')
                                ->url('#'),

                            NavigationItem::make('Log Aktivitas')
                                ->icon('heroicon-o-clock')
                                ->url('#'),
                        ]),
                ]);
            })

            // ── Pages & Widgets ───────────────────────────────  
            ->pages([
                AdminDashboard::class,
                ManajemenPengguna::class,
                ManajemenKampanye::class,
                ManajemenPembayaran::class,
                ManajemenPaket::class,
                ProfileAdmin::class,
                ManajemenWithdraw::class,
            ])
            ->discoverPages(
                in: app_path('Filament/Admin/Pages'),
                for: 'App\\Filament\\Admin\\Pages'
            )
            ->discoverResources(
                in: app_path('Filament/Admin/Resources'),
                for: 'App\\Filament\\Admin\\Resources'
            )
            ->widgets([
                Widgets\AccountWidget::class,
            ])

            // ── Assets ───────────────────────────────────────  
            ->renderHook(
                'panels::head.end',
                fn(): string => Blade::render("@vite(['resources/css/app.css', 'resources/css/filament-sidebar.css', 'resources/css/filament-topbar.css'])"),
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
