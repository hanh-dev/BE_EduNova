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
}
