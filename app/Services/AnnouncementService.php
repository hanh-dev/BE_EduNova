<?php

namespace App\Services;

use App\Repositories\AnnouncementRepository;

class AnnouncementService
{
    protected $announcementRepo;

    public function __construct(AnnouncementRepository $announcementRepo)
    {
        $this->announcementRepo = $announcementRepo;
    }

    public function createAnnouncement(array $data)
    {
        return $this->announcementRepo->store($data);
    }

    public function getAnnouncementsForAdmin()
    {
        return $this->announcementRepo->getAllAnnouncement();
    }

    public function deleteAnnouncementById($id)
    {
        return $this->announcementRepo->deleteAnnouncement($id);
    }

    public function getAnnouncementsByUser($userId)
    {
        return $this->announcementRepo->getAnnouncementsByUserId($userId);
    }
}
