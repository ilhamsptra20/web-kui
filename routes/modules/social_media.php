<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialMediaController;

Route::get('social_media/list',[SocialMediaController::class,'list'])->name('social_media.list');

Route::resource('social_media',SocialMediaController::class);