<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

Route::get('settings/list',[SettingController::class,'list'])->name('settings.list');

Route::resource('settings',SettingController::class);