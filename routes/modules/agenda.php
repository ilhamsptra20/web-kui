<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

Route::get('agendas/list',[AgendaController::class,'list'])->name('agendas.list');

Route::resource('agendas',AgendaController::class);