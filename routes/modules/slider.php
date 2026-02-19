<?php

use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('sliders/list', [SliderController::class, 'list'])->name('sliders.list');
Route::resource('sliders', SliderController::class)->parameters(['sliders' => 'uuid']);