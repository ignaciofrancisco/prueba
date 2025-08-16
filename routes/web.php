<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\AuthController;

// Login como página principal
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas públicas: Registro y Login
Route::view('/registro', 'auth.register')->name('registro'); 
Route::post('/registro', [AuthController::class, 'registerWeb'])->name('registro.web');

Route::view('/login', 'auth.login')->name('login'); 
Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.web');

// Rutas protegidas
Route::middleware('auth.session')->group(function () {

    // CRUD Proyectos
    Route::get('proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
    Route::post('proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
    Route::get('proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
    Route::get('proyectos/{id}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
    Route::put('proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
    Route::get('proyectos/{id}/delete', [ProyectoController::class, 'delete'])->name('proyectos.delete');
    Route::delete('proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');


    // Logout
    Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');
});
