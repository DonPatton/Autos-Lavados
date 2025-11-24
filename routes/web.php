<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoController; // IMPORTANTE
use App\Http\Controllers\LavadoController;

Route::get('/', function () {
    return view('inicio');
});


//rutas para autos
Route::get('/autos', [AutoController::class, 'index']);

Route::get('/autos/create', [AutoController::class, 'create']);

Route::post('/autos', [AutoController::class, 'store']);

Route::get('/autos/{auto}/edit', [AutoController::class, 'edit']);

Route::put('/autos/{auto}', [AutoController::class, 'update']);

Route::delete('/autos/{auto}', [AutoController::class, 'destroy']);


//rutas para lavados
Route::get('/lavados', [LavadoController::class, 'index']);

Route::get('/lavados/create', [LavadoController::class, 'create']);

Route::post('/lavados', [LavadoController::class, 'store']);

Route::get('/lavados/{lavado}/edit', [LavadoController::class, 'edit']);

Route::put('/lavados/{lavado}', [LavadoController::class, 'update']);

Route::delete('/lavados/{lavado}', [LavadoController::class, 'destroy']);