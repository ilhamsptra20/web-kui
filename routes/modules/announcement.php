<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;

Route::get('announcements/list',[AnnouncementController::class,'list'])->name('announcements.list');

Route::resource('announcements',AnnouncementController::class);