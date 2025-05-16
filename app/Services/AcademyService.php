<?php

namespace App\Services;

use App\Repositories\AcademyRepository;
use Illuminate\Support\Facades\Storage;

class AcademyService
{
    protected $academyRepo;

    public function __construct(AcademyRepository $repo) {
        $this->academyRepo = $repo;
    }

    public function list() {
        return $this->academyRepo->getAll();
    }

    public function get($id) {
        return $this->academyRepo->findById($id);
    }

    public function create($data) {
        $this->handleMediaFile(null, $data);
        return $this->academyRepo->create($data);
    }

    public function update($id, $data) {
        $academy = $this->academyRepo->findById($id);
        $this->handleMediaFile($academy, $data);
        return $this->academyRepo->update($id, $data);
    }

    public function delete($id) {
        $academy = $this->academyRepo->findById($id);
        if ($academy->media_path) {
            Storage::disk('public')->delete($academy->media_path);
        }
        return $this->academyRepo->delete($id);
    }

    private function handleMediaFile($academy, &$data) {
        if (isset($data['media_file'])) {
            if ($academy && $academy->media_path) {
                Storage::disk('public')->delete($academy->media_path);
            }
            $path = $data['media_file']->store('uploads', 'public');
            $data['media_path'] = $path;
            unset($data['media_file']);
        }
    }
}
