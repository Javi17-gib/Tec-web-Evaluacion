<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'dashboard'], function() {

    Route::get("/", function() {
        return view('admin.dashboard');   // resources/views/admin/dashboard.blade.php
    })->name('dashboard.home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
