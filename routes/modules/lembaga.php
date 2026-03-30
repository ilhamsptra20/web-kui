<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LembagaController;

Route::get('lembagas/list',[LembagaController::class,'list'])->name('lembagas.list');

Route::resource('lembagas',LembagaController::class);