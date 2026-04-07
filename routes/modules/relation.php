<?php

use App\Http\Controllers\RelationController;
use Illuminate\Support\Facades\Route;

Route::get('relations/list', [RelationController::class, 'list'])->name('relations.list');
Route::resource('relations', RelationController::class);