<?php

use App\Http\Controllers\Marketing\ArticleController;
use App\Http\Controllers\Marketing\MarketingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MarketingController::class, 'index']);
Route::get('/about', function () {
    return view('pages.marketing.about');
});

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{slug}', [ArticleController::class, 'show']);
Route::get('/articles/category/{category}', [ArticleController::class, 'index']);
Route::get('/articles/tag/{tag}', [ArticleController::class, 'index']);

// Route::post('/blog/{slug}/comment', [CommentController::class, 'store'])->name('article.comment.store');


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    // Add more authenticated routes here
});
