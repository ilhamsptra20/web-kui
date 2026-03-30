<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

Route::get('teams/list',[TeamController::class,'list'])->name('teams.list');

Route::resource('teams',TeamController::class);