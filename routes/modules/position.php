<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;

Route::get('positions/list',[PositionController::class,'list'])->name('positions.list');

Route::resource('positions',PositionController::class);