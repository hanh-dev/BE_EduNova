<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InClassController;
use App\Http\Controllers\SelfStudyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Models\SelfStudy;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/v1/login', [AuthController::class, 'login']);
Route::post('/v1/logout', [AuthController::class, 'logout']);

Route::get('/v1/classes', [ClassController::class, 'index']);
Route::get('/v1/teachers', [TeacherController::class, 'index']);

Route::middleware('auth.jwt')->get('/profile', [ProductController::class, 'get']);

// Route::middleware('auth:api')->get('/profile', function () {
//     $user = JWTAuth::parseToken()->authenticate();
//     $user2 = Auth::user();
//     return [
//         "user1" => $user,
//         "user2" => $user2
//     ];
// });
Route::get('/inclass',[InClassController::class,'index']);
Route::put('/inclass/{id}',[InClassController::class,'update']);
Route::get('/inclass/{id}',[InClassController::class,'show']);

Route::get('/selfstudy',[SelfStudyController::class,'index']);
// Route::put('/selfstudy/{id}',[SelfStudyController::class,'update']);
// Route::get('/selfstudyclass',[SelfStudyController::class,'show']);

