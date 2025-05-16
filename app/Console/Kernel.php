<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\PurgeDeletedClasses::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('inspire')->everyMinute();
        $schedule->command('app:purge-deleted-classes')->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
