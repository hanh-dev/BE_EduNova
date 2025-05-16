<?php
namespace App\Repositories;

use App\Models\SelfStudy;

class SelfStudyRepository{
    protected $selfStudy;

    public function __construct(SelfStudy $selfStudy)
    {
        $this->selfStudy = $selfStudy;
    }

    public function find($id)
    {
        return $this->selfStudy->find($id);
    }
    public function getAll(){
        return $this->selfStudy::all();
    }

    public function create(array $data)
    {
        return $this->selfStudy->create($data);
    }

    
}