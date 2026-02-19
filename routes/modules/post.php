<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('posts/list', [PostController::class, 'list'])->name('posts.list');
Route::resource('posts', PostController::class)->parameters(['posts' => 'uuid']);