<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;

Route::get('galleries/list',[GalleryController::class,'list'])->name('galleries.list');

Route::resource('galleries',GalleryController::class);