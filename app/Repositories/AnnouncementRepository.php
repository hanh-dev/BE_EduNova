<?php

namespace App\Repositories;

use App\Models\Announcement;
use App\Models\User;

class AnnouncementRepository
{
    public function store(array $data): Announcement
    {
        return Announcement::create($data);
    }

    public function getAllAnnouncement()
    {
        
        $announcements = Announcement::with('class')->get();
        $announcements->transform(function ($announcement) {
            $announcement->target_name = $announcement->target_id
                ? ($announcement->class->name ?? 'Unknown Class')
                : 'All Students';
            return $announcement;
        });

        return $announcements;
    }

    public function deleteAnnouncement($announcementId)
    {
        $announcement = Announcement::find($announcementId);

        if (!$announcement) {
            return false;
        }

        return $announcement->delete();
    }

    public function getAnnouncementsByUserId($userId)
    {
        return User::findOrFail($userId)
            ->announcements()
            ->with(['targetUser', 'class', 'creator'])
            ->withPivot('is_read')
            ->latest()
            ->get();
    }

}
