<?php
namespace App\Repositories;

use App\Models\AnnouncementUser;

class AnnouncementUserRepository
{
    public function create(array $data): AnnouncementUser
    {
        return AnnouncementUser::create($data);
    }

    public function markAsRead(int $announcementId, int $userId): bool
    {
        return AnnouncementUser::where('announcement_id', $announcementId)
            ->where('user_id', $userId)
            ->update(['is_read' => true]);
    }

    public function hasRead(int $announcementId, int $userId): bool
    {
        return AnnouncementUser::where('announcement_id', $announcementId)
            ->where('user_id', $userId)
            ->where('is_read', true)
            ->exists();
    }
}
