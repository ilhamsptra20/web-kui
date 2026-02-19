<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard');
});


Route::get('/form', function () {
    return view('pages.form-components');
});

Route::get('/form-mentah', function () {
    return view('pages.form');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
