<?php

namespace App\Http\Controllers;

use App\Services\GoalService;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    protected $goalService;

    public function __construct(GoalService $goalService)
    {
        $this->goalService = $goalService;
    }

    // Lấy tất cả mục tiêu
    public function index()
    {
        return response()->json($this->goalService->getAllGoals(), 200);
    }

    // Tạo mục tiêu mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course' => 'required|string',
            'goals' => 'required|string',
            'courseExpectations' => 'required|string',
            'teacherExpectations' => 'required|string',
            'selfExpectations' => 'required|string',
            'dueDate' => 'required|date',
        ]);

        $goal = $this->goalService->createGoal($validated);

        return response()->json($goal, 201);
    }

    // Cập nhật mục tiêu
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu nhập vào
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course' => 'required|string',
            'goals' => 'required|string',
            'courseExpectations' => 'required|string',
            'teacherExpectations' => 'required|string',
            'selfExpectations' => 'required|string',
            'dueDate' => 'required|date',
        ]);

        // Gọi dịch vụ cập nhật mục tiêu
        $goal = $this->goalService->updateGoal($id, $validated);

        // Kiểm tra xem mục tiêu có tồn tại không
        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        // Trả về mục tiêu đã được cập nhật
        return response()->json($goal, 200);
    }

    // Lấy mục tiêu theo ID
    public function show($id)
    {
        $goal = $this->goalService->getGoalById($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200);
    }
}
