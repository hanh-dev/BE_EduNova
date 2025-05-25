<?php

namespace App\Services;

use App\Repositories\WeekRepository;

class WeekService
{
    protected $weekRepository;

    public function __construct(WeekRepository $weekRepository)
    {
        $this->weekRepository = $weekRepository;
    }

    public function getAllWeeks()
    {
        return $this->weekRepository->getAll();
    } 

  public function createWeek(array $data)
{
    return $this->weekRepository->create($data);
}

}
