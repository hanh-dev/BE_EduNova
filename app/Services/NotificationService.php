<?php
// app/Services/NotificationService.php

namespace App\Services;

use App\Repositories\NotificationRepository;

class NotificationService
{
    protected $repo;

    public function __construct(NotificationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function notifyTag($senderId, $receiverId, $content, $link = null)
    {
        return $this->repo->create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'content' => $content,
            'link' => $link,
        ]);
    }

    public function getUserNotifications($userId)
    {
        return $this->repo->getForUser($userId);
    }

    public function markRead($id)
    {
        return $this->repo->markAsRead($id);
    }
}
