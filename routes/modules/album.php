<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

Route::get('albums/list', [AlbumController::class, 'list'])->name('albums.list');
Route::resource('albums', AlbumController::class)->parameters(['albums' => 'uuid']);