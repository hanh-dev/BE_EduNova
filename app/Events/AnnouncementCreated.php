<?php
namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AnnouncementCreated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $announcement;
    public $targetUserIds;

    public function __construct($announcement, $targetUserIds = [])
    {
        $this->announcement = $announcement;
        $this->targetUserIds = $targetUserIds;
    }

    public function broadcastOn()
    {
        return collect($this->targetUserIds)
            ->map(fn($id) => new PrivateChannel("user.$id"))
            ->all();
    }

    public function broadcastAs()
    {
        return 'announcement.created';
    }
}
