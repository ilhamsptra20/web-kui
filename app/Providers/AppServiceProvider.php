<?php

namespace App\Providers;

use App\Support\Navigation\NavigationService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
            $view->with('marketingNavbarItems', app(NavigationService::class)->marketingNavbar());
        });

        View::composer('components.layout.marketing.footer', function ($view): void {
            $view->with('marketingFooterItems', app(NavigationService::class)->marketingFooter());
        });
    }
}
