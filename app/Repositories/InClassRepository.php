<?php
namespace App\Repositories;

use App\Models\InCLass;

class InClassRepository
{
    protected $inClassModel;

    public function __construct(InClass $inClassModel)
    {
        $this->inClassModel = $inClassModel;
    }

    public function create(array $data)
    {
        return $this->inClassModel->create($data);
    }

    public function find($id)
    {
        return $this->inClassModel->find($id);
    }
    public function getAll()
    {
        return $this->inClassModel::all();
    }
    public function deleteInClass($id)
    {
        $inclass = $this->inClassModel->find($id);

        if (!$inclass) {
            return null;
        }

        $inclass->delete();
        return true;
    }
}
