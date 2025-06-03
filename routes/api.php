<?php

use AnnouncementCreated as GlobalAnnouncementCreated;
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
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AnnouncementUserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WeekGoalController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\WeekController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/v1/login', [AuthController::class, 'login']);
Route::post('/v1/logout', [AuthController::class, 'logout']);

// Route::get('/v1/teachers', [TeacherController::class, 'index']);

Route::middleware('auth.jwt')->get('/profile', [ProductController::class, 'get']);
// Class management
Route::get('/v1/classes', [ClassController::class, 'index']);
Route::get('/v1/classes/stats', [ClassController::class, 'getClassStats']);
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

// Inclass
Route::get('/inclass',[InClassController::class,'index']);
Route::put('/inclass/{id}',[InClassController::class,'update']);
Route::get('/inclass/{id}',[InClassController::class,'show']);
Route::delete('/inclass/{id}',[InClassController::class,'destroy']);
Route::post('/inclass', [InClassController::class, 'store']);

Route::get('/selfstudy',[SelfStudyController::class,'index']);
Route::get('/selfstudy/{id}', [SelfStudyController::class, 'show']); 
Route::put('/selfstudy/{id}', [SelfStudyController::class, 'update']); 
Route::post('/selfstudy', [SelfStudyController::class, 'store']);
Route::delete('/selfstudy/{id}', [SelfStudyController::class, 'destroy']);

// 
Route::get('/task', [TaskController::class, 'index']);

//Week's Goal
Route::get('/week-goals', [WeekGoalController::class, 'getAllWeekGoals']);
Route::get('/week-goals/{id}', [WeekGoalController::class, 'getWeekGoal']);
Route::post('/week-goals', [WeekGoalController::class, 'storeWeekGoal']);
Route::put('/week-goals/{id}', [WeekGoalController::class, 'updateWeekGoal']);
Route::put('/week-goals/{id}/status', [WeekGoalController::class, 'updateWeekGoalStatus']);
Route::delete('/week-goals/{id}', [WeekGoalController::class, 'deleteWeekGoal']);
Route::get('/week-goals/status/{status}', [WeekGoalController::class, 'getWeekGoalsByStatus']);


// Test
// Route::get('/upload-form', [UserController::class, 'get']);
Route::post('/v1/student', [UserController::class, 'create']);
Route::delete('/v1/student/{id}', [UserController::class, 'destroyStudent']);
Route::patch('/v1/student/{id}', [UserController::class, 'updateStudent']);
Route::post('/v1/messages/send', [MessageController::class, 'sendMessage']);
Route::post('/v1/messages/reply', [MessageController::class, 'replyToStudent']);

//Semester
Route::get('/semester', [SemesterController::class, 'index']);
Route::get('/semester/{id}', [SemesterController::class, 'show']);
Route::post('/semester', [SemesterController::class, 'store']);
Route::put('/semester/{id}', [SemesterController::class, 'update']);

// Week
Route::get('/week', [WeekController::class, 'getAllWeeks']);
Route::post('/week', [WeekController::class, 'createWeek']);

// Announcement
Route::get('/v1/announcement', [AnnouncementController::class, 'index']);
Route::post('/v1/announcement/markAsRead', [AnnouncementUserController::class, 'markAsRead']);
Route::get('/v1/announcement/user/{userId}', [AnnouncementController::class, 'getByUser']);

Route::delete('/v1/announcement/{id}', [AnnouncementController::class, 'deleteAnnouncement']);
Route::post('/v1/announcement', [AnnouncementController::class, 'store']);
use App\Events\AnnouncementCreated;
use App\Http\Controllers\TagTeacherController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;



Route::get('/test-event', function () {
    $announcement = [
        'title' => 'Test',
        'content' => 'Hello user 63!',
    ];
    broadcast(new AnnouncementCreated($announcement, [63]));
    return 'sent';
});

Route::get('/test-broadcast', function () {
    $announcement = [
        'title' => 'Hello from Route',
        'content' => 'This is a test broadcast',
        'user_id' => 63
    ];
    Log::info('Broadcast driver in use: ', [config('broadcasting.default')]);
    Log::info('Broadcasting announcement (raw): ', $announcement);
    $jsonData = json_encode($announcement);
    Log::info('Broadcasting announcement (JSON): ', ['json' => $jsonData, 'error' => json_last_error_msg()]);
    try {
        $pusher = new \Pusher\Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS' => true,
                'debug' => true,
                'curl_options' => [
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_VERBOSE => true
                ]
            ]
        );
        $channelInfo = $pusher->get_channel_info('private-user.63');
        Log::info('Pusher channel info: ', ['info' => $channelInfo]);

        // Thử gửi dữ liệu đã encode JSON
        $result = $pusher->trigger('private-user.63', 'announcement.created', json_decode($jsonData, true));
        Log::info('Pusher trigger raw result: ', ['result' => var_export($result, true)]);
        if ($result === true) {
            Log::info('Broadcast sent successfully to private-user.63');
        } elseif ($result === false) {
            Log::error('Pusher trigger failed');
        } else {
            Log::warning('Pusher trigger returned unexpected result: ', ['result' => var_export($result, true)]);
        }
        return $result === true ? 'Broadcast sent!' : 'Broadcast failed or unexpected result';
    } catch (\Exception $e) {
        Log::error('Broadcast error: ', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        return 'Broadcast failed: ' . $e->getMessage();
    }
});

// Route::post('/broadcasting/auth', function (Request $request) {
//     Log::debug('Broadcast auth attempt:', [
//         'user' => auth('api')->user(),
//         'channel' => $request->channel_name,
//         'token' => $request->header('Authorization')
//     ]);
//     return Broadcast::auth($request);
// })->middleware('jwt.auth');


Route::post('/broadcasting/auth', function (Request $request) {
    Log::debug('Broadcast auth attempt:', [
        'user' => auth('apiapi')->user(),
        'channel' => $request->channel_name,
        'headers' => $request->headers->all(),
    ]);
    return Broadcast::auth($request);
});

Broadcast::routes(['middleware' => ['auth:api']]); 

// routes/api.php

Route::get('/test-broadcast-user-63', function () {
    $userIdToTest = 63;

    $dummyAnnouncement = (object) [
        'id' => uniqid(),
        'title' => 'Test Announcement for User 63',
        'content' => 'This is a test notification specifically for user ' . $userIdToTest,
        'priority' => 'high',
        'created_by' => 1,
    ];

    $targetUserIds = [$userIdToTest];

    Log::info('📣 Broadcasting test announcement for user ID 63', ['userIds' => $targetUserIds]);

    broadcast(new AnnouncementCreated($dummyAnnouncement, $targetUserIds));

    return response()->json([
        'status' => true,
        'message' => 'Test announcement broadcasted to user ' . $userIdToTest
    ]);
});

Route::get('/week-goals', [WeekGoalController::class, 'getAllWeekGoals']);
Route::get('/week-goals/{id}', [WeekGoalController::class, 'getWeekGoal']);
Route::post('/week-goals', [WeekGoalController::class, 'storeWeekGoal']);
Route::put('/week-goals/{id}', [WeekGoalController::class, 'updateWeekGoal']);
Route::put('/week-goals/{id}/status', [WeekGoalController::class, 'updateWeekGoalStatus']);
Route::delete('/week-goals/{id}', [WeekGoalController::class, 'deleteWeekGoal']);
Route::get('/week-goals/status/{status}', [WeekGoalController::class, 'getWeekGoalsByStatus']);
Route::get('/goal/status/{status}', [GoalController::class, 'getGoalsByStatus']);

Route::post('/tag-teacher', [TagTeacherController::class, 'sendTagTeacher']);
Route::get('/tag-teacher', [TagTeacherController::class, 'getTagTeacher']);
Route::get('/tag-teacher/goal/{goalId}', [TagTeacherController::class, 'getTagTeacherByGoal']);
Route::post('/tag-teacher/response', [TagTeacherController::class, 'sendTeacherResponse']);
Route::get('/tag-teacher/student', [TagTeacherController::class, 'getStudentResponses']);
Route::post('/tag-teacher/mark-read', [TagTeacherController::class, 'markResponseAsRead']);
