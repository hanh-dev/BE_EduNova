<?php
namespace App\Services;

use App\Repositories\InClassRepository;

class InClassService
{
    protected $inClassRepository;

    public function __construct(InClassRepository $inClassRepository)
    {
        $this->inClassRepository = $inClassRepository;
    }
    public function getAllClass()
    {
        return $this->inClassRepository->getAll();
    }
    public function createGoal(array $data)
    {
        return $this->inClassRepository->create($data);
    }
    public function updateInclass($id, array $data)
    {
        $inclass = $this->inClassRepository->find($id);

        if (!$inclass) {
            return null;
        }

        $inclass->update($data);

        return $inclass;
    }

    public function getInClasServiceById($id)
    {
        return $this->inClassRepository->find($id);
    }
    public function getInClassById($id)
    {
        return $this->inClassRepository->find($id);
    }
    public function deleteInClass($id)
    {
        return $this->inClassRepository->deleteInClass($id);
    }
}
