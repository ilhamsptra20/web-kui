<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('categories/list',[CategoryController::class,'list'])->name('categories.list');

Route::resource('categories',CategoryController::class);