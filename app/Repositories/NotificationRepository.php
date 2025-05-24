<?php
namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository
{
    public function create(array $data)
    {
        return Notification::create($data);
    }

    public function getForUser($userId)
    {
        return Notification::where('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function markAsRead($id)
    {
        return Notification::where('id', $id)->update(['is_read' => true]);
    }
}
