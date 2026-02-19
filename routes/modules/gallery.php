<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('galleries/list', [GalleryController::class, 'list'])->name('galleries.list');
Route::resource('galleries', GalleryController::class)->parameters(['galleries' => 'uuid']);