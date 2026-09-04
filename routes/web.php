<?php

use App\Http\Controllers\ChirpsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpsController::class, 'index']);
Route::post('/chirps', [ChirpsController::class, 'store']);
Route::get('/chirps/{chirp}/edit', [ChirpsController::class, 'edit']);
Route::put('/chirps/{chirp}', [ChirpsController::class, 'update']);
Route::delete('/chirps/{chirp}', [ChirpsController::class, 'destroy']);

// Route::resource('chirps', ChirpsController::class)
//     ->only(['store', 'edit', 'update', 'destroy']);