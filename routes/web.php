<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GreetingsController;

// Rute dasar
Route::get('/', [GreetingsController::class, 'welcome']);

// Rute dengan parameter
Route::get('/greet/{name}/{npm}', [GreetingsController::class, 'greet']);