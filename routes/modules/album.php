<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;

Route::get('albums/list',[AlbumController::class,'list'])->name('albums.list');

Route::resource('albums',AlbumController::class);