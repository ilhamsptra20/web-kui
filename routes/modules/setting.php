<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::get('settings/create', [SettingController::class, 'create'])->name('settings.create');
Route::get('settings/{setting}', [SettingController::class, 'show'])->name('settings.show');
Route::get('settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
Route::post('settings/publish', [SettingController::class, 'publish'])->name('settings.publish');
Route::delete('settings/{setting}', [SettingController::class, 'destroy'])->name('settings.destroy');
