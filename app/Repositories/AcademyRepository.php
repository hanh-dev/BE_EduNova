<?php 
namespace App\Repositories;

use App\Models\Academy;

class AcademyRepository
{
    public function getAll() {
        return Academy::all();
    }

    public function findById($id) {
        return Academy::findOrFail($id);
    }

    public function create(array $data) {
        return Academy::create($data);
    }

    public function update($id, array $data) {
        $academy = Academy::findOrFail($id);
        $academy->update($data);
        return $academy;
    }

    public function delete($id) {
        $academy = Academy::findOrFail($id);
        return $academy->delete();
    }
}
