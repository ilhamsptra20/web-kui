<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;

Route::get('sliders/list',[SliderController::class,'list'])->name('sliders.list');

Route::resource('sliders',SliderController::class);