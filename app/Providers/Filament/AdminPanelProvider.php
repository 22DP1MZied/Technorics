<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

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
                'primary' => Color::Emerald,
                'danger' => Color::Rose,
                'gray' => Color::Zinc,
                'info' => Color::Emerald,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
            ])
            ->brandName('Technorics')
            ->brandLogo(fn () => new HtmlString('
                <div class="flex items-center gap-3">
                    <img src="' . asset('images/logo.png') . '" alt="Technorics" class="h-10 w-auto object-contain">
                    <span class="text-xl font-bold text-gray-900 dark:text-white">Technorics</span>
                </div>
            '))
            ->darkModeBrandLogo(fn () => new HtmlString('
                <div class="flex items-center gap-3">
                    <img src="' . asset('images/logo.png') . '" alt="Technorics" class="h-10 w-auto object-contain">
                    <span class="text-xl font-bold text-white">Technorics</span>
                </div>
            '))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ])
            ->darkMode(true)
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                'panels::body.end',
                fn () => Blade::render('<script>
                    if (window.location.pathname.includes("/admin/login")) {
                        const observer = new MutationObserver(() => {
                            const form = document.querySelector("form");
                            if (form && !document.getElementById("back-home-link")) {
                                const link = document.createElement("div");
                                link.id = "back-home-link";
                                link.className = "text-center mt-6";
                                link.innerHTML = `<a href="/" class="text-sm text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition font-semibold inline-flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                    Back to Home
                                </a>`;
                                form.parentElement.appendChild(link);
                                observer.disconnect();
                            }
                        });
                        observer.observe(document.body, { childList: true, subtree: true });
                    }
                </script>')
            );
    }
}
