<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MarketingController::class, 'index']);
Route::get('/about', function () {
    return view('pages.marketing.about');
});

Route::get('/articles', function () {
    return view('pages.marketing.articles.index');
});

Route::get('/articles-detail', function () {
    return view('pages.marketing.articles.show');
});

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
