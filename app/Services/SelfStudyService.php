<?php 
namespace App\Services;

use App\Repositories\SelfStudyRepository;

class SelfStudyService{
    protected $selfStudyRepository;

    public function __construct(SelfStudyRepository $selfStudyRepository)
    {
        $this->selfStudyRepository = $selfStudyRepository;
    }
    public function getAllClass(){
        return $this->selfStudyRepository->getAll();
    }

    public function updateSelfStudy($id,array $data)
    {
        $selfstudy = $this->selfStudyRepository->find($id);

        if (!$selfstudy) {
            return null;
        }

        $selfstudy->update($data);

        return $selfstudy;
    }

    public function getInClasServiceById($id)
    {
        return $this->selfStudyRepository->find($id);
    }
    
}