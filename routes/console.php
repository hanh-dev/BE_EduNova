<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('app:send-goal-reminder')
    ->weekly()
    ->mondays()
    ->at('09:00')
    ->timezone('Asia/Jakarta'); 
Schedule::command('notify:weekly-goal-reminder')
    ->weeklyOn(7, '09:00');
