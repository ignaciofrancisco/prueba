<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;

Route::post('/registro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth.jwt')->group(function(){
    Route::get('/proyectos',[ProyectoController::class,'index']);
});
