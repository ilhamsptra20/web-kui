<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('videos/list',[VideoController::class,'list'])->name('videos.list');

Route::resource('videos',VideoController::class);