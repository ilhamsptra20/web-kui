<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('posts/list',[PostController::class,'list'])->name('posts.list');

Route::resource('posts',PostController::class);