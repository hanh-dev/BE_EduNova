<?php 
namespace App\Services;

use App\Repositories\GoalRepository;

class GoalService {

    protected $goalRepository;

    public function __construct(GoalRepository $goalRepository)
    {
        $this->goalRepository = $goalRepository;
    }

    // Tạo mới một mục tiêu
    public function createGoal(array $data)
    {
        return $this->goalRepository->create($data);
    }

    // Lấy tất cả các mục tiêu
    public function getAllGoals()
    {
        return $this->goalRepository->getAll();
    }

    // Lấy một mục tiêu theo ID
    public function getGoalById($id)
    {
        return $this->goalRepository->find($id);
    }

    // Cập nhật thông tin mục tiêu
    public function updateGoal($id, array $data)
    {
        $goal = $this->goalRepository->find($id);

        if (!$goal) {
            return null;
        }

        return $this->goalRepository->update($id, $data);
    }

    // Cập nhật trạng thái hoàn thành của mục tiêu
    public function updateGoalStatus($id, $status)
    {
        $goal = $this->goalRepository->find(id: $id);

        if (!$goal) {
            return null;
        }

        // Cập nhật trạng thái của mục tiêu
        $goal->completeStatus = $status;
        $goal->save();

        return $goal;
    }

    // Xóa một mục tiêu
    public function deleteGoal($id)
    {
        return $this->goalRepository->deleteGoal($id);
    }

     public function getGoalsByStatus($status)
    {
        return $this->goalRepository->getGoalsByStatus($status);
    }
}
