<?php

namespace App\Repositories;

use App\Models\Goal;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GoalRepository
{
    protected $goalModel;

    public function __construct(Goal $goalModel)
    {
        $this->goalModel = $goalModel;
    }

    // Tạo mục tiêu mới
    public function create(array $data)
    {
        try {
            return $this->goalModel->create($data); // Tạo mục tiêu mới
        } catch (\Exception $e) {
            // Xử lý lỗi nếu tạo không thành công
            throw new \Exception("Error creating goal: " . $e->getMessage());
        }
    }

    // Tìm mục tiêu theo ID
    public function find($id)
    {
        $goal = $this->goalModel->find($id);

        if (!$goal) {
            throw new ModelNotFoundException("Goal not found with ID: $id");
        }

        return $goal;
    }

    // Cập nhật mục tiêu
    public function update($id, array $data)
    {
        // Tìm mục tiêu theo ID
        $goal = $this->goalModel->find($id);
        
        // Nếu không tìm thấy mục tiêu, ném ngoại lệ
        if (!$goal) {
            throw new ModelNotFoundException("Goal not found with ID: $id");
        }

        // Cập nhật thông tin mục tiêu
        $goal->update($data);

        return $goal;  // Trả về mục tiêu đã cập nhật
    }

    // Lấy tất cả các mục tiêu
    public function getAll()
    {
        return $this->goalModel::all(); // Lấy tất cả các mục tiêu
    }
}
