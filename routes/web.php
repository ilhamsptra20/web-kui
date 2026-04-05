<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EditorImageController;
use App\Http\Controllers\Helper\LanguageController;
use App\Http\Controllers\Marketing\AboutController;
use App\Http\Controllers\Marketing\AnnouncementController;
use App\Http\Controllers\Marketing\ArticleController;
use App\Http\Controllers\Marketing\ContactController;
use App\Http\Controllers\Marketing\EventController;
use App\Http\Controllers\Marketing\GalleryController;
use App\Http\Controllers\Marketing\MarketingController;
use App\Http\Controllers\Marketing\TeamController as MarketingTeamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('track.visitors')->group(function () {
    Route::get('/', [MarketingController::class, 'index']);
    Route::get('/about', [AboutController::class, 'index'])->name('about-marketing');
    Route::get('/team', [MarketingTeamController::class, 'index'])->name('teams-marketing');
    Route::get('/team/{team:slug}', [MarketingTeamController::class, 'show'])->name('team.show-marketing');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact-marketing');

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles-marketing');
    Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('article.show-marketing');
    Route::get('/articles/category/{category}', [ArticleController::class, 'index'])->name('article.category-marketing');
    Route::get('/articles/tag/{tag}', [ArticleController::class, 'index'])->name('article.tag-marketing');

    Route::get('/events', [EventController::class, 'index'])->name('events-marketing');
    Route::get('/events/{slug}', [EventController::class, 'show'])->name('event.show-marketing');

    Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcements-marketing');
    Route::get('/announcement/{id}', [AnnouncementController::class, 'show'])->name('announcements.marketing.show');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery-marketing');
    Route::get('/gallery/{album:slug}', [GalleryController::class, 'show'])->name('gallery.show-marketing');
});

// Route::post('/blog/{slug}/comment', [CommentController::class, 'store'])->name('article.comment.store');

Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Auth::routes();

Route::middleware('auth')->group(function () {
    $registerModuleRoutes = static function (string $permission, string $file): void {
        Route::middleware("permission:{$permission}")->group(function () use ($file): void {
            require $file;
        });
    };

    Route::middleware('permission:dashboard.view')->group(function (): void {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    });

    Route::post('/editor-images', [EditorImageController::class, 'store'])->name('editor-images.store');

    $registerModuleRoutes('agenda.manage', __DIR__.'/modules/agenda.php');
    $registerModuleRoutes('album.manage', __DIR__.'/modules/album.php');
    $registerModuleRoutes('announcement.manage', __DIR__.'/modules/announcement.php');
    $registerModuleRoutes('category.manage', __DIR__.'/modules/category.php');
    $registerModuleRoutes('gallery.manage', __DIR__.'/modules/gallery.php');
    $registerModuleRoutes('inbox.manage', __DIR__.'/modules/inbox.php');
    $registerModuleRoutes('lembaga.manage', __DIR__.'/modules/lembaga.php');
    $registerModuleRoutes('page.manage', __DIR__.'/modules/page.php');
    $registerModuleRoutes('position.manage', __DIR__.'/modules/position.php');
    $registerModuleRoutes('post.manage', __DIR__.'/modules/post.php');
    $registerModuleRoutes('setting.manage', __DIR__.'/modules/setting.php');
    $registerModuleRoutes('slider.manage', __DIR__.'/modules/slider.php');
    $registerModuleRoutes('social_media.manage', __DIR__.'/modules/social_media.php');
    $registerModuleRoutes('team.manage', __DIR__.'/modules/team.php');
    $registerModuleRoutes('user.manage', __DIR__.'/modules/user.php');
    $registerModuleRoutes('video.manage', __DIR__.'/modules/video.php');
    $registerModuleRoutes('navigation.manage', __DIR__.'/modules/navigation.php');
    $registerModuleRoutes('role.manage', __DIR__.'/modules/role.php');
    $registerModuleRoutes('permission.manage', __DIR__.'/modules/permission.php');
});








