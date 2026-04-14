<?php

namespace App\Providers;

use App\Models\Relation;
use App\Models\SocialMedia;
use App\Services\SettingService;
use App\Support\Navigation\NavigationService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
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
        RateLimiter::for('marketing-inbox', function (Request $request): array {
            $identity = $request->ip().'|'.strtolower((string) $request->input('email', 'guest'));

            return [
                Limit::perMinute(3)->by($request->ip()),
                Limit::perHour(12)->by($identity),
            ];
        });

        View::composer('components.layout.sidebar', function ($view): void {
            $settingService = app(SettingService::class);

            $view->with([
                'adminSidebarItems' => app(NavigationService::class)->adminSidebar(),
                'adminBrandSettings' => $settingService->only([
                    'sidebar_logo' => '/assets/logo/unida.png',
                ]),
            ]);
        });

        View::composer(['layouts.app', 'layouts.auth'], function ($view): void {
            $view->with('adminLayoutSettings', app(SettingService::class)->only([
                'favicon_logo' => '/favicon.ico',
            ]));
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
                    'primary_contact_button_text' => 'Hubungi KUI',
                    'primary_contact_button_url' => route('contact-marketing'),
                ]),
            ]);
        });

        View::composer('components.layout.marketing.footer', function ($view): void {
            $settingService = app(SettingService::class);
            $socialLinks = Schema::hasTable('social_media')
                ? SocialMedia::query()
                    ->orderBy('name')
                    ->get()
                    ->map(fn (SocialMedia $item) => [
                        'title' => $item->name ?: 'Social Media',
                        'icon' => $item->icon ?: 'ri-global-line',
                        'url' => $item->link ?: '#',
                    ])
                    ->values()
                    ->all()
                : [];

            $relationLinks = Schema::hasTable('relations')
                ? Relation::query()
                    ->orderBy('title')
                    ->get()
                    ->values()
                    ->all()
                : [];

            $view->with([
                'marketingFooterItems' => app(NavigationService::class)->marketingFooter(),
                'marketingFooterBrand' => $settingService->only([
                    'site_logo' => '/assets/logo/unida.png',
                    'footer_logo' => '/assets/logo/unida.png',
                ]),
                'marketingFooterContent' => $settingService->only([
                    'footer_address' => 'Kampus Universitas Juanda, Ciawi, Bogor, Jawa Barat, Indonesia',
                    'footer_email' => 'kui@unida.ac.id',
                    'footer_phone' => '+62 251 8246475',
                    'footer_newsletter_title' => 'Informasi & Update KUI',
                    'footer_newsletter_placeholder' => 'Masukkan email Anda',
                    'footer_copyright' => 'Copyright © 2026 KUI Universitas Juanda. All Rights Reserved.',
                ]),
                'marketingSocialLinks' => $socialLinks !== [] ? $socialLinks : [
                    ['title' => 'Facebook', 'icon' => 'ri-facebook-fill', 'url' => 'https://www.facebook.com/'],
                    ['title' => 'Instagram', 'icon' => 'ri-instagram-line', 'url' => 'https://www.instagram.com/'],
                    ['title' => 'YouTube', 'icon' => 'ri-youtube-fill', 'url' => 'https://www.youtube.com/'],
                    ['title' => 'LinkedIn', 'icon' => 'ri-linkedin-fill', 'url' => 'https://www.linkedin.com/'],
                ],
                'marketingRelations' => $relationLinks !== [] ? $relationLinks : [
                    ['title' => 'Universitas Juanda', 'url' => 'https://www.unida.ac.id/'],
                    ['title' => 'Fakultas Ilmu Komputer', 'url' => 'https://fik.unida.ac.id/'],
                    ['title' => 'Himpunan Mahasiswa Informatika', 'url' => 'https://himaif.unida.ac.id/'],
                ],
            ]);
        });

        View::composer('layouts.marketing', function ($view): void {
            $view->with('marketingLayoutSettings', app(SettingService::class)->only([
                'favicon_logo' => '/favicon.ico',
            ]));
        });
    }
}
