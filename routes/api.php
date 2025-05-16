<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/v1/login', [AuthController::class, 'login']);
Route::post('/v1/logout', [AuthController::class, 'logout']);

Route::get('/v1/teachers', [TeacherController::class, 'index']);

Route::middleware('auth.jwt')->get('/profile', [ProductController::class, 'get']);
// Class management
Route::get('/v1/classes', [ClassController::class, 'index']);
Route::post('/v1/classes', [ClassController::class, 'create']);
Route::delete('/v1/classes/{id}', [ClassController::class, 'delete']);
Route::patch('/v1/classes/{id}', [ClassController::class, 'updateClass']);
// Student management
Route::get('/v1/students', [UserController::class, 'getStudents']);
// Teacher management
Route::get('/v1/teachers', [UserController::class, 'getTeachers']);