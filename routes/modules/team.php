<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('teams/list', [TeamController::class, 'list'])->name('teams.list');
Route::resource('teams', TeamController::class)->parameters(['teams' => 'uuid']);