<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->font('Red Hat Mono')
            ->brandLogo(asset('images/caticon.svg'))
            ->favicon(asset('images/caticon.svg'))
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->plugins([
                \Schmeits\FilamentUmami\FilamentUmamiPlugin::make()
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetStatsGrouped::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetGraphPageViews::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetGraphSessions::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetGraphEvents::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableGroupedPages::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableGroupedGeo::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableGroupedClientInfo::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableUrls::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableTitle::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableReferrers::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableCountry::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableRegion::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableCity::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableDevice::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableOs::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableBrowser::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableLanguage::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableScreen::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableEvents::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetTableQuery::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetStatsLiveVisitors::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetStatsPageViews::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetStatsVisitors::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetStatsVisits::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetStatsBounces::class,
                \Schmeits\FilamentUmami\Widgets\UmamiWidgetStatsTotalTime::class,
            ])
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
            ->authMiddleware([
                Authenticate::class,
            ])->navigationItems([
                NavigationItem::make('Analytics')
                    ->url('http://localhost:3000', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-presentation-chart-line')

            ]);
    }
}
