<?php

namespace App\Services;

use App\Repositories\GoalRepository;

class GoalService {

    protected $goalRepository;
    
    // Constructor nhận vào GoalRepository
    public function __construct(GoalRepository $goalRepository)
    {
        $this->goalRepository = $goalRepository;
    }

    // Tạo mục tiêu mới
    public function createGoal(array $data)
    {
        return $this->goalRepository->create($data);
    }

    // Lấy tất cả mục tiêu
    public function getAllGoals()
    {
        return $this->goalRepository->getAll();
    }

    // Cập nhật mục tiêu
    public function updateGoal($id, array $data)
    {
        // Tìm mục tiêu theo ID
        $goal = $this->goalRepository->find($id);
        
        // Nếu không tìm thấy mục tiêu, trả về null
        if (!$goal) {
            return null;
        }

        // Cập nhật mục tiêu nếu tìm thấy
        return $this->goalRepository->update($id, $data);
    }

    // Lấy mục tiêu theo ID
    public function getGoalById($id)
    {
        return $this->goalRepository->find($id);
    }
}
