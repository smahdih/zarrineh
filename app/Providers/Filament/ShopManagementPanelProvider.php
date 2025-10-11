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
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\FontProviders\LocalFontProvider;

class ShopManagementPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('shopManagement')
            ->path('shopManagement')
            ->authGuard('shop')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->font(
                'dana',
                asset('build/assets/app-BfUD28Bx.css'),
                LocalFontProvider::class,
            )
            ->discoverResources(
                in: app_path('Filament/ShopManagement/Resources'),
                for: 'App\Filament\ShopManagement\Resources',
            )
            ->discoverPages(
                in: app_path('Filament/ShopManagement/Pages'),
                for: 'App\Filament\ShopManagement\Pages',
            )
            ->pages([Dashboard::class])
            ->discoverWidgets(
                in: app_path('Filament/ShopManagement/Widgets'),
                for: 'App\Filament\ShopManagement\Widgets',
            )
            ->widgets([AccountWidget::class, FilamentInfoWidget::class])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([Authenticate::class]);
    }
}
