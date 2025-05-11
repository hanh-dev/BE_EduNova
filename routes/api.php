<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth.jwt')->get('/profile', [ProductController::class, 'get']);

// Route::middleware('auth:api')->get('/profile', function () {
//     $user = JWTAuth::parseToken()->authenticate();
//     $user2 = Auth::user();
//     return [
//         "user1" => $user,
//         "user2" => $user2
//     ];
// });
