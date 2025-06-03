<?php
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
                'student_id' => $item->student->id ?? null,
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

    public function getStudentResponses(Request $request)
    {
        try {
            $studentId = $request->query('studentId');
            if (!$studentId) {
                throw new \Exception('Student ID is required');
            }

            $responses = $this->service->getStudentResponses($studentId);

            $result = $responses->map(function($item) {
                return [
                    'id' => $item->id,
                    'student_name' => $item->student->name ?? 'Unknown',
                    'teacher_name' => $item->teacher->name ?? 'Unknown',
                    'message' => $item->message,
                    'teacher_response' => $item->teacher_response,
                    'created_at' => $item->created_at->toDateTimeString(),
                    'goal_id' => $item->goal_id,
                    'is_read' => $item->is_read,
                ];
            });

            return response()->json(['success' => true, 'data' => $result]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function markResponseAsRead(Request $request)
    {
        try {
            $tagId = $request->input('tagId');
            if (!$tagId) {
                throw new \Exception('Tag ID is required');
            }

            $tag = $this->service->markResponseAsRead($tagId);
            return response()->json(['success' => true, 'data' => $tag]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }
}