<?php

use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

Route::get('positions/list', [PositionController::class, 'list'])->name('positions.list');
Route::resource('positions', PositionController::class)->parameters(['positions' => 'uuid']);