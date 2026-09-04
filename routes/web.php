<?php

use App\Http\Controllers\ChirpsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpsController::class, 'index']);
Route::post('/chirps', [ChirpsController::class, 'store']);