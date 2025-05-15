<?php
namespace App\Repositories;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalRepository
{
    protected $goalModel;

    public function __construct(Goal $goalModel)
    {
        $this->goalModel = $goalModel;
    }

    // Tạo mới một mục tiêu
    public function create(array $data)
    {
        return $this->goalModel->create($data);
    }

    // Lấy mục tiêu theo ID
    public function find($id)
    {
        return $this->goalModel->find($id);
    }

    // Cập nhật mục tiêu
    public function update($id, array $data)
    {
        $goal = $this->goalModel->find($id);

        if (!$goal) {
            return null;
        }

        $goal->update($data);
        return $goal;
    }

    // Lấy tất cả các mục tiêu
    public function getAll()
    {
        return $this->goalModel::all();
    }

    // Xóa một mục tiêu
    public function deleteGoal($id)
    {
        $goal = $this->goalModel->find($id);

        if (!$goal) {
            return null;
        }

        $goal->delete();
        return true;
    }

    // Cập nhật trạng thái hoàn thành của mục tiêu
    public function updateGoalStatus($id, $status)
    {
        $goal = $this->goalModel->find($id);

        if (!$goal) {
            return null;
        }

        // Cập nhật trạng thái của mục tiêu
        $goal->completeStatus = $status;
        $goal->save();

        return $goal;
    }

      public function getGoalsByStatus($status)
    {
        return $this->goalModel->where('completeStatus', $status)->get();
    }
    public function updateCompleteStatus(Request $request, $id)
{
    $validated = $request->validate([
        'completeStatus' => 'in:doing,done', // Kiểm tra trạng thái hợp lệ
    ]);

    $goal = $this->goalModel->updateGoalStatus($id, $validated['completeStatus']);

    if (!$goal) {
        return response()->json(['message' => 'Goal not found'], 404);
    }

    return response()->json($goal, 200); // Trả lại goal đã được cập nhật
}

}
