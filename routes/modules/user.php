<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users/list', [UserController::class, 'list'])->name('users.list');
Route::resource('users', UserController::class);
