<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboxController;

Route::get('inboxes/list',[InboxController::class,'list'])->name('inboxes.list');

Route::resource('inboxes',InboxController::class);