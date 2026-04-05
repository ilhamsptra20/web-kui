<?php

use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;

Route::get('navigations/list', [NavigationController::class, 'list'])->name('navigations.list');
Route::resource('navigations', NavigationController::class);
