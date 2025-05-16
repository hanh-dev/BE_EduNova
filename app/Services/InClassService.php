<?php 
namespace App\Services;

use App\Repositories\InClassRepository;

class InClassService{
    protected $inClassRepository;

    public function __construct(InClassRepository $inClassRepository)
    {
        $this->inClassRepository = $inClassRepository;
    }
    public function getAllClass(){
        return $this->inClassRepository->getAll();
    }

    public function updateInclass($id,array $data)
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
    
}