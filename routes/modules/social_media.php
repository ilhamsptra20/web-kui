<?php

use App\Http\Controllers\SocialMediaController;
use Illuminate\Support\Facades\Route;

Route::get('social_media/list', [SocialMediaController::class, 'list'])->name('social_media.list');
Route::resource('social_media', SocialMediaController::class);