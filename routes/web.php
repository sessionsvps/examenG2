<?php

use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('clientes', ClienteController::class);
    Route::resource('videos', VideoController::class);
    Route::resource('alquileres', AlquilerController::class);
});
