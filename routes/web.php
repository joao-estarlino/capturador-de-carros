<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarrosController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', fn () => view('login'))->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/captura', function () { return view('captura'); });
Route::post('/capturar-carros', [CarrosController::class, 'capturarCarros'])->name('carros.capturar');
Route::get('/carros', [CarrosController::class, 'index'])->name('carros.index');
Route::delete('/carros/{carro}', [CarrosController::class, 'destroy'])->name('carros.destroy');