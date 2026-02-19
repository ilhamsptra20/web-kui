<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Services\Contracts\CategoryServiceInterface::class, \App\Services\CategoryService::class);
        $this->app->bind(\App\Repositories\Contracts\CategoryRepositoryInterface::class, \App\Repositories\CategoryRepository::class);
        $this->app->bind(\App\Services\Contracts\PositionServiceInterface::class, \App\Services\PositionService::class);
        $this->app->bind(\App\Repositories\Contracts\PositionRepositoryInterface::class, \App\Repositories\PositionRepository::class);
        $this->app->bind(\App\Services\Contracts\AlbumServiceInterface::class, \App\Services\AlbumService::class);
        $this->app->bind(\App\Repositories\Contracts\AlbumRepositoryInterface::class, \App\Repositories\AlbumRepository::class);
        $this->app->bind(\App\Services\Contracts\PostServiceInterface::class, \App\Services\PostService::class);
        $this->app->bind(\App\Repositories\Contracts\PostRepositoryInterface::class, \App\Repositories\PostRepository::class);
        $this->app->bind(\App\Services\Contracts\TeamServiceInterface::class, \App\Services\TeamService::class);
        $this->app->bind(\App\Repositories\Contracts\TeamRepositoryInterface::class, \App\Repositories\TeamRepository::class);
        $this->app->bind(\App\Services\Contracts\GalleryServiceInterface::class, \App\Services\GalleryService::class);
        $this->app->bind(\App\Repositories\Contracts\GalleryRepositoryInterface::class, \App\Repositories\GalleryRepository::class);
        $this->app->bind(\App\Services\Contracts\AgendaServiceInterface::class, \App\Services\AgendaService::class);
        $this->app->bind(\App\Repositories\Contracts\AgendaRepositoryInterface::class, \App\Repositories\AgendaRepository::class);
        $this->app->bind(\App\Services\Contracts\AnnouncementServiceInterface::class, \App\Services\AnnouncementService::class);
        $this->app->bind(\App\Repositories\Contracts\AnnouncementRepositoryInterface::class, \App\Repositories\AnnouncementRepository::class);
        $this->app->bind(\App\Services\Contracts\VideoServiceInterface::class, \App\Services\VideoService::class);
        $this->app->bind(\App\Repositories\Contracts\VideoRepositoryInterface::class, \App\Repositories\VideoRepository::class);
        $this->app->bind(\App\Services\Contracts\InboxServiceInterface::class, \App\Services\InboxService::class);
        $this->app->bind(\App\Repositories\Contracts\InboxRepositoryInterface::class, \App\Repositories\InboxRepository::class);
        $this->app->bind(\App\Services\Contracts\SocialMediaServiceInterface::class, \App\Services\SocialMediaService::class);
        $this->app->bind(\App\Repositories\Contracts\SocialMediaRepositoryInterface::class, \App\Repositories\SocialMediaRepository::class);
        $this->app->bind(\App\Services\Contracts\SliderServiceInterface::class, \App\Services\SliderService::class);
        $this->app->bind(\App\Repositories\Contracts\SliderRepositoryInterface::class, \App\Repositories\SliderRepository::class);
        $this->app->bind(\App\Services\Contracts\SettingServiceInterface::class, \App\Services\SettingService::class);
        $this->app->bind(\App\Repositories\Contracts\SettingRepositoryInterface::class, \App\Repositories\SettingRepository::class);
        // MODULE_BINDINGS
    }
}