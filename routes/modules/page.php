<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('pages/list', [PageController::class, 'list'])->name('pages.list');
Route::resource('pages', PageController::class)->parameters(['pages' => 'uuid']);