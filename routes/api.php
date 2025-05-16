<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InClassController;
use App\Http\Controllers\SelfStudyController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use App\Models\SelfStudy;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\WeekGoalController;
use App\Http\Controllers\TaskController;

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


Route::get('/goal', [GoalController::class, 'index']);
Route::post('/goal', [GoalController::class, 'store']);
Route::get('/goal/{id}', [GoalController::class, 'show']);
Route::put('/goal/{id}', [GoalController::class, 'update']);
Route::delete('/goal/{id}', [GoalController::class, 'destroy']);
Route::put('/goal/{id}/completeStatus', [GoalController::class, 'updateCompleteStatus']);
//Week's Goal
Route::get('/week-goals', [WeekGoalController::class, 'getAllWeekGoals']);
Route::get('/week-goals/{id}', [WeekGoalController::class, 'getWeekGoal']);
Route::post('/week-goals', [WeekGoalController::class, 'storeWeekGoal']);
Route::put('/week-goals/{id}', [WeekGoalController::class, 'updateWeekGoal']);
Route::put('/week-goals/{id}/status', [WeekGoalController::class, 'updateWeekGoalStatus']);
Route::delete('/week-goals/{id}', [WeekGoalController::class, 'deleteWeekGoal']);
Route::get('/week-goals/status/{status}', [WeekGoalController::class, 'getWeekGoalsByStatus']);

Route::get('/task', [TaskController::class, 'index']);