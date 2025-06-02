<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\WeeklyStudentNotification;
use App\Models\NotificationTemplate;

class SendStudentNotification extends Command
{
    protected $signature = 'notification:send';

    protected $description = 'Gửi thông báo cho sinh viên mỗi phút';

    public function handle()
    {
        $title = 'Thông báo mới từ giáo viên';
        $content = 'Hãy chú ý học tập tốt nhé - ' . now()->format('H:i:s');

        // Lưu vào bảng notification_templates
        NotificationTemplate::create([
            'title' => $title,
            'content' => $content,
        ]);

        // Gửi realtime (ví dụ cho sinh viên có id = 63)
        broadcast(new WeeklyStudentNotification($title, $content))->toOthers();

        $this->info('Thông báo đã được gửi');
    }
}
