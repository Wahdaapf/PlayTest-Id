<?php
 
namespace App\Providers\Filament;  
  
use App\Filament\Auth\Pages\Login;
use App\Filament\Auth\Pages\RequestResetPassword;
use App\Filament\Auth\Pages\ResetPassword;
use App\Filament\Admin\Pages\AdminDashboard;  
use App\Filament\Admin\Pages\ManajemenPengguna;
use Filament\Http\Middleware\Authenticate;  
use Filament\Http\Middleware\AuthenticateSession;  
use Filament\Http\Middleware\DisableBladeIconComponents;  
use Filament\Http\Middleware\DispatchServingFilamentEvent;  
use Filament\Navigation\NavigationBuilder;  
use Filament\Navigation\NavigationGroup;  
use Filament\Navigation\NavigationItem;  
use Filament\Pages;  
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
                'warning' => Color::Amber,  // badge Pending tetap amber  
            ])  
  
            // ── Sidebar Navigation ────────────────────────────  
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {  
                return $builder->groups([  
                    NavigationGroup::make('Menu Utama')  
                        ->items([  
                            NavigationItem::make('Dashboard')  
                                 ->icon('heroicon-o-squares-2x2')  
                                 ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.admin-dashboard'))  
                                 ->url(fn () => AdminDashboard::getUrl()),  
  
                             NavigationItem::make('Pengguna')  
                                 ->icon('heroicon-o-users')  
                                 ->badge(fn () => \App\Models\User::count())  
                                 ->isActiveWhen(fn () => request()->is('admin/manajemen-pengguna*'))
                                 ->url(fn () => ManajemenPengguna::getUrl()),  
  
                             NavigationItem::make('Kampanye')  
                                 ->icon('heroicon-o-paper-airplane')  
                                 ->badge(\App\Models\Paket::count())
                                 ->url(fn () => \App\Filament\Admin\Resources\Pakets\PaketResource::getUrl()),  
  
                             NavigationItem::make('Transaksi')  
                                 ->icon('heroicon-o-currency-dollar')  
                                 ->url(fn () => \App\Filament\Admin\Resources\Pembayarans\PembayaranResource::getUrl()),  
                        ]),  
  
                    NavigationGroup::make('Sistem')  
                        ->items([  
                            NavigationItem::make('Pengaturan')  
                                ->icon('heroicon-o-cog-6-tooth')  
                                ->url('#'),  
  
                            NavigationItem::make('Log Aktivitas')  
                                ->icon('heroicon-o-document-text')  
                                ->url('#'),  
                        ]),  
                ]);  
            })  
  
            // ── Pages & Widgets ───────────────────────────────  
            ->pages([  
                AdminDashboard::class,  
                ManajemenPengguna::class,
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
                fn (): string => Blade::render("
                    @vite('resources/css/app.css')
                    <style>
                        /* Sidebar Main Background to White */
                        .fi-sidebar {
                            background-color: #ffffff !important;
                            border-right: 1px solid #e2e8f0 !important;
                        }

                        /* Sidebar Header/Logo Area */
                        .fi-sidebar-header {
                            background-color: #ffffff !important;
                            border-bottom: 1px solid #f1f5f9 !important;
                        }

                        /* Sidebar Navigation Area */
                        .fi-sidebar-nav {
                            background-color: #ffffff !important;
                        }

                        /* Sidebar Group Label Customization */
                        .fi-sidebar-group-label {
                            font-weight: 800;
                            letter-spacing: 0.12em;
                            font-size: 0.7rem;
                            color: #94a3b8 !important;
                            margin-top: 1.5rem;
                            text-transform: uppercase;
                        }
                        
                        /* Sidebar Item Base */
                        .fi-sidebar-item {
                            margin-bottom: 4px;
                            padding: 0 12px;
                        }

                        .fi-sidebar-item-button {
                            border-radius: 12px !important;
                            color: #64748b !important;
                        }

                        .fi-sidebar-item-button:hover {
                            background-color: #f8fafc !important;
                            color: #1e293b !important;
                        }
                        
                        /* Sidebar Active State - Pill Shape & Brand Color */
                        .fi-sidebar-item-active > a,
                        .fi-sidebar-item-active > button {
                            background-color: #eff6ff !important;
                            color: #2563eb !important;
                            border-radius: 12px !important;
                            position: relative;
                            font-weight: 700 !important;
                        }
                        
                        /* Vertical Indicator for Active Item */
                        .fi-sidebar-item-active > a::before,
                        .fi-sidebar-item-active > button::before {
                            content: '';
                            position: absolute;
                            left: 0;
                            top: 50%;
                            transform: translateY(-50%);
                            height: 40%;
                            width: 3.5px;
                            background-color: #2563eb;
                            border-radius: 0 4px 4px 0;
                        }
                        
                        /* Icon Color for Active Item */
                        .fi-sidebar-item-active .fi-sidebar-item-icon {
                            color: #2563eb !important;
                        }

                        /* Sidebar Footer / User Area */
                        .fi-sidebar-footer {
                            background-color: #ffffff !important;
                            border-top: 1px solid #f1f5f9 !important;
                        }
                        
                        /* Responsive Adjustments for 100% Zoom */
                        @media (min-width: 1024px) {
                            .fi-sidebar {
                                width: 18rem;
                            }
                        }
                        
                        /* Transition Effects */
                        .fi-sidebar-item-button {
                            transition: all 0.2s ease;
                        }
                    </style>
                "),  
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
