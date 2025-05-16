<?php

use App\Http\Controllers\GoalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InClassController;
use App\Http\Controllers\SelfStudyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\SelfStudy;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\AcademyController;
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

Route::patch('/v1/classes/{id}', [ClassController::class, 'updateClass']);
Route::get('/academies', [AcademyController::class, 'index']);
Route::post('/academies', [AcademyController::class,'store']);
Route::get('/academies/{id}', [AcademyController::class, 'show']);
Route::put('/academies/{id}', [AcademyController::class, 'update']); 
Route::delete('/academies/{id}', [AcademyController::class, 'destroy']);


Route::get('/goal', [GoalController::class, 'index']);
Route::post('/goal', [GoalController::class, 'store']);
Route::get('/goal/{id}', [GoalController::class, 'show']);
Route::put('/goal/{id}', [GoalController::class, 'update']);
Route::delete('/goal/{id}', [GoalController::class, 'destroy']);
Route::put('/goal/{id}/completeStatus', [GoalController::class, 'updateCompleteStatus']);

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
Route::get('/selfstudy/{id}', [SelfStudyController::class, 'show']); 
Route::put('/selfstudy/{id}', [SelfStudyController::class, 'update']); 
Route::post('/selfstudy', [SelfStudyController::class, 'store']); 
