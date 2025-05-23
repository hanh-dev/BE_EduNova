<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClassRepository
{
    protected $model;

    public function __construct(User $userModel)
    {
        $this->model = $userModel;
    }

    public function countByMonth(string $year, string $month): int
    {
        return $this->model
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
    }
}