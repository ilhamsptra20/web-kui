<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('roles/list', [RoleController::class, 'list'])->name('roles.list');
Route::resource('roles', RoleController::class);
