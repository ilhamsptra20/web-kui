<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

Route::get('agendas/list', [AgendaController::class, 'list'])->name('agendas.list');
Route::resource('agendas', AgendaController::class)->parameters(['agendas' => 'uuid']);