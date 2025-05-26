<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WeeklyGoalReminderNotification;
use Illuminate\Console\Command;

class NotifyStudentsWeeklyGoalReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:weekly-goal-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gửi thông báo cho học sinh để nhắc hoàn thành goals vào cuối tuần';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students = User::where('role', 'student')->get();

        foreach ($students as $student) {
            $student->notify(new WeeklyGoalReminderNotification());
        }

        $this->info('Đã gửi thông báo nhắc nhở đến toàn bộ học sinh.');
    }
}
