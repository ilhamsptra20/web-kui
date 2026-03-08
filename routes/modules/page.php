<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('pages/list',[PageController::class,'list'])->name('pages.list');

Route::resource('pages',PageController::class);