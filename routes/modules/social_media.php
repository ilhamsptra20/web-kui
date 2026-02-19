<?php

use App\Http\Controllers\SocialMediaController;
use Illuminate\Support\Facades\Route;

Route::get('social-media/list', [SocialMediaController::class, 'list'])->name('social-media.list');
Route::resource('social-media', SocialMediaController::class)->parameters(['social_media' => 'uuid']);