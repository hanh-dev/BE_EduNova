<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\WeekGoalController;

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