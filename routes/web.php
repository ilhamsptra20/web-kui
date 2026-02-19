<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    // Add more authenticated routes here

    require __DIR__.'/modules/category.php';
    require __DIR__.'/modules/position.php';
    require __DIR__.'/modules/album.php';
    require __DIR__.'/modules/post.php';
    require __DIR__.'/modules/team.php';
    require __DIR__.'/modules/gallery.php';
    require __DIR__.'/modules/agenda.php';
    require __DIR__.'/modules/announcement.php';
    require __DIR__.'/modules/video.php';
    require __DIR__.'/modules/inbox.php';
    require __DIR__.'/modules/social_media.php';
    require __DIR__.'/modules/slider.php';
    require __DIR__.'/modules/setting.php';
});
