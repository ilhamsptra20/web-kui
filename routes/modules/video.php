<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('videos/list', [VideoController::class, 'list'])->name('videos.list');
Route::resource('videos', VideoController::class)->parameters(['videos' => 'uuid']);