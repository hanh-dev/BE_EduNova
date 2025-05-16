<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\AcademyController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth.jwt')->get('/profile', [ProductController::class, 'get']);
Route::get('/academies', [AcademyController::class, 'index']);
Route::post('/academies', [AcademyController::class,'store']);
Route::get('/academies/{id}', [AcademyController::class, 'show']);
Route::put('/academies/{id}', [AcademyController::class, 'update']); 
Route::delete('/academies/{id}', [AcademyController::class, 'destroy']); 
