<?php
namespace App\Repositories;

use App\Models\InCLass;

class InClassRepository{
    protected $inClassModel;

    public function __construct(InClass $inClassModel)
    {
        $this->inClassModel = $inClassModel;
    }

    public function find($id)
    {
        return $this->inClassModel->find($id);
    }
    public function getAll(){
        return $this->inClassModel::all();
    }
}