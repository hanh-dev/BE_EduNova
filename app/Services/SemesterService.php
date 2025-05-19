<?php

namespace App\Services;

use App\Repositories\SemesterRepository;

class SemesterService
{
    protected $semesterRepository;

    public function __construct(SemesterRepository $semesterRepository)
    {
        $this->semesterRepository = $semesterRepository;
    }

    public function getAllSemesters()
    {
        return $this->semesterRepository->getAll();
    }

    public function getSemesterById($id)
    {
        return $this->semesterRepository->getById($id);
    }
public function createSemester(array $data)
{
    $existingSemesters = $this->semesterRepository->getAll();
    $nextNumber = count($existingSemesters) + 1;
    
    if (!isset($data['name']) || empty($data['name'])) {
        $data['name'] = "Học kỳ " . $nextNumber;
    }

    return $this->semesterRepository->create($data);
}

}
