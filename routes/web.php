<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/v1/api/product', [ProductController::class, 'store']);

Route::middleware('auth.jwt')->get('/profile', [ProductController::class, 'get']);
Route::post('/login', [AuthController::class, 'login']);