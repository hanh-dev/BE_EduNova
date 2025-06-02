<?php
namespace App\Services;

use App\Repositories\AnnouncementUserRepository;

class AnnouncementUserService
{
    protected $announcementUserRepository;

    public function __construct(AnnouncementUserRepository $repo)
    {
        $this->announcementUserRepository = $repo;
    }

    public function assignToUser(int $announcementId, int $userId)
    {
        return $this->announcementUserRepository->create([
            'announcement_id' => $announcementId,
            'user_id' => $userId,
            'is_read' => false,
        ]);
    }

    public function markAsRead(int $announcementId, int $userId)
    {
        return $this->announcementUserRepository->markAsRead($announcementId, $userId);
    }

    public function checkIfRead(int $announcementId, int $userId): bool
    {
        return $this->announcementUserRepository->hasRead($announcementId, $userId);
    }
}
