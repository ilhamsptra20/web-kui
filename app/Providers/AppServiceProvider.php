<?php

namespace App\Providers;

use App\Services\SettingService;
use App\Support\Navigation\NavigationService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.layout.sidebar', function ($view): void {
            $view->with('adminSidebarItems', app(NavigationService::class)->adminSidebar());
        });

        View::composer('components.layout.marketing.navbar', function ($view): void {
            $settingService = app(SettingService::class);

            $view->with([
                'marketingNavbarItems' => app(NavigationService::class)->marketingNavbar(),
                'marketingBrandSettings' => $settingService->only([
                    'site_logo' => '/assets/logo/unida.png',
                    'site_logo_light' => '/assets/logo/unida.png',
                    'site_logo_dark' => '/assets/logo/unida.png',
                ]),
                'marketingContactButton' => $settingService->only([
                    'primary_contact_button_text' => 'Get In Touch',
                    'primary_contact_button_url' => route('contact-marketing'),
                ]),
            ]);
        });

        View::composer('components.layout.marketing.footer', function ($view): void {
            $settingService = app(SettingService::class);

            $view->with([
                'marketingFooterItems' => app(NavigationService::class)->marketingFooter(),
                'marketingFooterBrand' => $settingService->only([
                    'site_logo' => '/assets/logo/unida.png',
                    'footer_logo' => '/assets/logo/unida.png',
                ]),
                'marketingFooterContent' => $settingService->only([
                    'footer_address' => '952 Bad Hill St, Asheville, NC 28803, USA',
                    'footer_email' => 'contact@aixio.com',
                    'footer_phone' => '+96 76867 8869',
                    'footer_newsletter_title' => 'Subscribe To Our Newsletter',
                    'footer_newsletter_placeholder' => 'Enter Your Email',
                    'footer_copyright' => 'Copyright © 2026 Nabila Maulidia. All Rights Reserved.',
                ]),
            ]);
        });

        View::composer('layouts.marketing', function ($view): void {
            $view->with('marketingLayoutSettings', app(SettingService::class)->only([
                'favicon_logo' => '/favicon.ico',
            ]));
        });
    }
}
