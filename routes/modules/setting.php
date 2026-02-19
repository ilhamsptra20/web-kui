<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('settings/list', [SettingController::class, 'list'])->name('settings.list');
Route::resource('settings', SettingController::class)->parameters(['settings' => 'uuid']);