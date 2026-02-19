<?php

use App\Http\Controllers\InboxController;
use Illuminate\Support\Facades\Route;

Route::get('inboxes/list', [InboxController::class, 'list'])->name('inboxes.list');
Route::resource('inboxes', InboxController::class)->parameters(['inboxes' => 'uuid']);