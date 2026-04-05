<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('permissions/list', [PermissionController::class, 'list'])->name('permissions.list');
Route::resource('permissions', PermissionController::class);
