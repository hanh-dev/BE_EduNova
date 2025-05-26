<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendGoalReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-goal-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly goal completion reminders to students';

    /**
     * Execute the console command.
     */
    public function handle()
    {
           User::updateOrCreate(
               ['title' => 'Weekly Goal Reminder'],
               [
                   'message' => 'Please remember to fill in your weekly goals. Visit the goals page to complete them.',
                   'is_active' => true,
                   'created_at' => now(),
                   'updated_at' => now(),
               ]
           );

           $this->info('Weekly goal announcement created successfully!');
    }
}
