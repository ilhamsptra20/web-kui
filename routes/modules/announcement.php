<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::get('announcements/list', [AnnouncementController::class, 'list'])->name('announcements.list');
Route::resource('announcements', AnnouncementController::class)->parameters(['announcements' => 'uuid']);