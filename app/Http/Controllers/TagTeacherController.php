<?php
//===================CHÍNH==================
// namespace App\Http\Controllers;

// use App\Services\TagTeacherService;
// use Illuminate\Http\Request;
// use App\Models\User;


// class TagTeacherController extends Controller
// {
//     protected $service;

//     public function __construct(TagTeacherService $service)
//     {
//         $this->service = $service;
//     }

//     public function sendTagTeacher(Request $request)
//     {
//         try {
//             $teacherId = $request->input('teacherId');
//             $message = $request->input('message');
//             $user_id = $request->input('user_id');
//             $goal_id = $request->input('goalId');

//             if (!$teacherId || !$message) {
//                 throw new \Exception('Teacher and message are required');
//             }

//             $tagTeacher = $this->service->sendTagTeacher($teacherId, $message, $user_id, $goal_id);
//             return response()->json(['success' => true, 'data' => $tagTeacher]);
//         } catch (\Exception $e) {
//             return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
//         }
//     }
//     public function getTagTeacher(Request $request)
// {
//     try {
//         $teacherId = $request->query('teacherId');
//         if (!$teacherId) {
//             throw new \Exception('Teacher ID is required');
//         }

//         $notifications = $this->service->getTagTeacher($teacherId);

//         // Chỉ trả về các trường cần thiết cho frontend
//         $result = $notifications->map(function($item) {
//             return [
//                 'student_name' => $item->student->name ?? 'Unknown',
//                 'message' => $item->message,
//                 'student_id' => $item->student->id ?? null,
//                 'created_at' => $item->created_at->toDateTimeString(),
//                 'goal_id' => $item->goal_id,   // thêm goal_id ở đây
//             ];
//         });

//         return response()->json(['success' => true, 'data' => $result]);
//     } catch (\Exception $e) {
//         return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
//     }
// }
//========================================END CHÍNH==================


namespace App\Http\Controllers;

use App\Services\TagTeacherService;
use Illuminate\Http\Request;
use App\Models\User;
class TagTeacherController extends Controller
{
    protected $service;

    public function __construct(TagTeacherService $service)
    {
        $this->service = $service;
    }

    public function sendTagTeacher(Request $request)
    {
        try {
            $teacherId = $request->input('teacherId');
            $message = $request->input('message');
            $user_id = $request->input('user_id');
            $goal_id = $request->input('goalId');

            if (!$teacherId || !$message) {
                throw new \Exception('Teacher and message are required');
            }

            $tagTeacher = $this->service->sendTagTeacher($teacherId, $message, $user_id, $goal_id);
            return response()->json(['success' => true, 'data' => $tagTeacher]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function getTagTeacher(Request $request)
    {
        try {
            $teacherId = $request->query('teacherId');
            if (!$teacherId) {
                throw new \Exception('Teacher ID is required');
            }

            $notifications = $this->service->getTagTeacher($teacherId);

            $result = $notifications->map(function($item) {
                return [
                    'student_name' => $item->student->name ?? 'Unknown',
                    'message' => $item->message,
                    'student_id' => $item->student->id ?? null,
                    'created_at' => $item->created_at->toDateTimeString(),
                    'goal_id' => $item->goal_id,
                ];
            });

            return response()->json(['success' => true, 'data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function getTagTeacherByGoal(Request $request, $goalId)
    {
        try {
            $teacherId = $request->query('teacherId');
            if (!$teacherId || !$goalId) {
                throw new \Exception('Teacher ID and Goal ID are required');
            }

            $tag = $this->service->getTagTeacherByGoal($goalId, $teacherId);
            if (!$tag) {
                return response()->json(['success' => false, 'error' => 'Tag not found'], 404);
            }

            $result = [
                'id' => $tag->id,
                'student_name' => $tag->student->name ?? 'Unknown',
                'message' => $tag->message,
                'student_id' => $tag->student->id ?? null,
                'teacher_response' => $tag->teacher_response,
                'created_at' => $tag->created_at->toDateTimeString(),
                'goal_id' => $tag->goal_id,
            ];

            return response()->json(['success' => true, 'data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function sendTeacherResponse(Request $request)
    {
        try {
            $tagId = $request->input('tagId');
            $teacherResponse = $request->input('teacher_response');

            if (!$tagId || !$teacherResponse) {
                throw new \Exception('Tag ID and response are required');
            }

            $tag = $this->service->sendTeacherResponse($tagId, $teacherResponse);
            return response()->json(['success' => true, 'data' => $tag]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }
}


// }
// namespace App\Http\Controllers;

// use App\Services\TagTeacherService;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Auth\Access\AuthorizationException;

// class TagTeacherController extends Controller
// {
//     protected $service;

//     public function __construct(TagTeacherService $service)
//     {
//         $this->service = $service;
//     }

//     // Gửi tag giáo viên
//     public function sendTagTeacher(Request $request)
//     {
//         $request->validate([
//             'teacherId'   => 'required|integer|exists:users,id',
//             'message'     => 'required|string',
//             'contextUrl'  => 'required|string',
//             'goalId'      => 'nullable|integer',
//             'contextType' => 'nullable|string',
//         ]);

//         try {
//             $teacherId   = $request->input('teacherId');
//             $message     = $request->input('message');
//             $contextUrl  = $request->input('contextUrl');
//             $goalId      = $request->input('goalId');
//             $contextType = $request->input('contextType', 'post');

//             $tagTeacher = $this->service->sendTagTeacher(
//                 $teacherId,
//                 $message,
//                 $contextUrl,
//                 $goalId,
//                 $contextType
//             );

//             return response()->json([
//                 'success' => true,
//                 'data' => $tagTeacher
//             ], 201);

//         } catch (AuthorizationException $e) {
//             return response()->json([
//                 'success' => false,
//                 'error' => $e->getMessage()
//             ], 403);

//         } catch (\Exception $e) {
//             return response()->json([
//                 'success' => false,
//                 'error' => $e->getMessage()
//             ], 400);
//         }
//     }

//     // Lấy danh sách thông báo cho giáo viên, có phân trang hoặc giới hạn
//     public function getTeacherNotifications(Request $request, $teacherId)
//     {
//         try {
//             $limit = $request->query('limit', 10); // lấy param limit, default 10
//             $notifications = $this->service->getTeacherNotifications((int)$teacherId, (int)$limit);

//             return response()->json([
//                 'success' => true,
//                 'data' => $notifications
//             ]);
//         } catch (\Exception $e) {
//             return response()->json([
//                 'success' => false,
//                 'error' => $e->getMessage()
//             ], 400);
//         }
//     }

//     // Lấy thông báo chưa đọc cho giáo viên
//     public function getUnreadNotifications($teacherId)
//     {
//         try {
//             $notifications = $this->service->getUnreadNotifications((int)$teacherId);

//             return response()->json([
//                 'success' => true,
//                 'data' => $notifications
//             ]);
//         } catch (\Exception $e) {
//             return response()->json([
//                 'success' => false,
//                 'error' => $e->getMessage()
//             ], 400);
//         }
//     }

//     // Đánh dấu thông báo đã đọc
//     public function markNotificationAsRead(Request $request, $teacherId, $notificationId)
//     {
//         try {
//             $updated = $this->service->markNotificationAsRead((int)$notificationId, (int)$teacherId);

//             return response()->json([
//                 'success' => true,
//                 'data' => $updated
//             ]);
//         } catch (\Exception $e) {
//             return response()->json([
//                 'success' => false,
//                 'error' => $e->getMessage()
//             ], 400);
//         }
//     }
// }
