<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('categories/list', [CategoryController::class, 'list'])->name('categories.list');
Route::resource('categories', CategoryController::class)->parameters(['categories' => 'uuid']);