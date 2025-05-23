<?php
namespace App\Repositories;

use App\Models\TagTeacher;

class TagTeacherRepository
{
    public function create(array $data)
    {
        return TagTeacher::create($data);
    }
}
