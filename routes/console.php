<?php
use App\Models\User;
use App\Models\NotificationTemplate;
use App\Events\WeeklyStudentNotification;
use App\Models\Announcement;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $template = Announcement::first();

    if (!$template) {
        logger('Không có mẫu thông báo để gửi');
        return;
    }

    broadcast(new WeeklyStudentNotification('Test', $template));

    logger('Đã gửi thông báo realtime chủ nhật');
})->everyMinute();
