<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Redirige al dashboard después del login
Route::get('/home', function() {
    return redirect()->route('dashboard.home');
})->name('home');

// Rutas protegidas por login
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');

    Route::get('/usuarios', [UsuarioController::class, 'getUsuarios'])->name('usuarios.get');
    Route::post('/usuarios', [UsuarioController::class, 'createUsuarios'])->name('usuarios.create');
    Route::delete('/usuarios', [UsuarioController::class, 'deleteUsuarios'])->name('usuarios.delete');
});


