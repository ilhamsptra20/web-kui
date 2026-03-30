<?php

use App\Http\Controllers\Helper\LanguageController;
use App\Http\Controllers\Marketing\AnnouncementController;
use App\Http\Controllers\Marketing\ArticleController;
use App\Http\Controllers\Marketing\EventController;
use App\Http\Controllers\Marketing\GalleryController;
use App\Http\Controllers\Marketing\MarketingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MarketingController::class, 'index']);
Route::get('/about', function () {
    return view('pages.marketing.about');
})->name('about-marketing');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles-marketing');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('article.show-marketing');
Route::get('/articles/category/{category}', [ArticleController::class, 'index'])->name('article.category-marketing');
Route::get('/articles/tag/{tag}', [ArticleController::class, 'index'])->name('article.tag-marketing');

Route::get('/events', [EventController::class, 'index'])->name('events-marketing');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('event.show-marketing');

Route::get('/announcement', function () {
    return view('pages.marketing.announcements');
})->name('announcements-marketing');

Route::get('/announcement',      [AnnouncementController::class, 'index'])->name('announcements-marketing');
Route::get('/announcement/{id}', [AnnouncementController::class, 'show'])->name('announcements.marketing.show');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery-marketing');

Route::get('/contact', function () {
    return view('pages.marketing.contact');
})->name('contact-marketing');

// Route::post('/blog/{slug}/comment', [CommentController::class, 'store'])->name('article.comment.store');

// routes/web.php
Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    // Add more authenticated routes here
    require __DIR__.'/modules/agenda.php';
    require __DIR__.'/modules/album.php';
    require __DIR__.'/modules/announcement.php';
    require __DIR__.'/modules/category.php';
    require __DIR__.'/modules/gallery.php';
    require __DIR__.'/modules/inbox.php';
    require __DIR__.'/modules/lembaga.php';
    require __DIR__.'/modules/page.php';
    require __DIR__.'/modules/position.php';
    require __DIR__.'/modules/post.php';
    require __DIR__.'/modules/setting.php';
    require __DIR__.'/modules/slider.php';
    require __DIR__.'/modules/social_media.php';
    require __DIR__.'/modules/team.php';
    require __DIR__.'/modules/video.php';
});
