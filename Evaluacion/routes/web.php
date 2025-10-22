<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispositivosController;
use App\Http\Controllers\AsignacionesController;
use App\Http\Controllers\CartaPoderController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return redirect()->route('dashboard.home');
})->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');

    Route::get('/usuarios', [UsuarioController::class, 'getUsuarios'])->name('usuarios.get');
    Route::post('/usuarios', [UsuarioController::class, 'createUsuarios'])->name('usuarios.create');
    Route::delete('/usuarios', [UsuarioController::class, 'deleteUsuarios'])->name('usuarios.delete');
    
    Route::get('/dispositivos', [DispositivosController::class, 'getDispositivos'])->name('dispositivos.index');
    Route::post('/dispositivos', [DispositivosController::class, 'createDispositivo'])->name('dispositivos.store');
    
    Route::get('/asignaciones', [AsignacionesController::class, 'index'])->name('asignaciones.index');
    Route::post('/asignaciones', [AsignacionesController::class, 'store'])->name('asignaciones.store');
    Route::post('/asignaciones/devolver/{id}', [AsignacionesController::class, 'devolver'])->name('asignaciones.devolver');

    // Generar carta poder desde una asignación
    Route::get('/carta-poder/{id}', [CartaPoderController::class, 'generar'])->name('carta.generar');
    
});
