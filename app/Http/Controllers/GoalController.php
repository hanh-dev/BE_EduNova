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

    public function index()
    {
        return response()->json($this->goalService->getAllGoals(), 200);
    }

    public function show($id)
    {
        $goal = $this->goalService->getGoalById($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200);
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
            'completeStatus' => 'in:doing,done', // Kiểm tra trạng thái hợp lệ
        ]);

        // Tạo mục tiêu mới
        $goal = $this->goalService->createGoal($validated);

        return response()->json($goal, 201);
    }

    // Cập nhật mục tiêu
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course' => 'required|string',
            'goals' => 'required|string',
            'courseExpectations' => 'required|string',
            'teacherExpectations' => 'required|string',
            'selfExpectations' => 'required|string',
            'dueDate' => 'required|date',
            'completeStatus' => 'in:doing,done'  // Kiểm tra trạng thái hợp lệ
        ]);

        $goal = $this->goalService->updateGoal($id, $validated);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200);
    }

    // Cập nhật trạng thái hoàn thành của mục tiêu (chỉ cập nhật trạng thái)
    public function updateCompleteStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'completeStatus' => 'in:doing,done', // Kiểm tra trạng thái hợp lệ
        ]);

        $goal = $this->goalService->updateGoalStatus($id, $validated['completeStatus']);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        return response()->json($goal, 200); // Trả lại goal đã được cập nhật
    }

    // Xóa mục tiêu
    public function destroy($id)
    {
        $goal = $this->goalService->getGoalById($id);

        if (!$goal) {
            return response()->json(['message' => 'Goal not found'], 404);
        }

        $this->goalService->deleteGoal($id);

        return response()->json(['message' => 'Goal deleted successfully'], 200);
    }
    public function getGoalsByStatus($status)
{
    // Kiểm tra trạng thái hợp lệ
    if (!in_array($status, ['doing', 'done'])) {
        return response()->json(['message' => 'Invalid status'], 400);
    }

    // Lấy các mục tiêu với trạng thái tương ứng
    $goals = $this->goalService->getGoalsByStatus($status);

    return response()->json($goals, 200);
}

}
