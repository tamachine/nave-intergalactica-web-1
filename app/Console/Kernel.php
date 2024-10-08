<?php

namespace App\Console;

use App\Services\NaveCache\NaveCache;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $clearCacheTask = function () {
            app(NaveCache::class)->clearAndRun();
        };
        
        $schedule->call($clearCacheTask)->everyTwoHours()->environments(['production']);

        $schedule->call($clearCacheTask)->everyFiveMinutes()->environments(['staging', 'local']);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
