<?php

use App\Http\Controllers\LembagaController;
use Illuminate\Support\Facades\Route;

Route::get('lembagas/list', [LembagaController::class, 'list'])->name('lembagas.list');
Route::resource('lembagas', LembagaController::class);