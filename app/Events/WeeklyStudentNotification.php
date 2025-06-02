<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class WeeklyStudentNotification implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $title;
    public $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function broadcastOn()
    {
        logger('BroadcastOn channel: user.63');
        return new PrivateChannel('user.63');
    }

    public function broadcastAs()
    {
        return 'weekly.student.notification';
    }

    public function broadcastWith()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
