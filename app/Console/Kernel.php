<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        Commands\JobNotification::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

//        $schedule->command('email:job_notification')
//            ->everyMinute();
//
//        $schedule->command('email:job_email')
//            ->everyMinute();

        $schedule->command('get:reportDaily')
            ->everyThirtyMinutes();
//        $schedule->command('create:adstxt')
//            ->everyFiveMinutes();

//        $schedule->command('callData:AdServer')
//            ->everyMinute();

        // Backups (to Google Drive)
        $schedule->command('backup:clean --disable-notifications')->dailyAt('01:30');
        $schedule->command('backup:run --only-db --disable-notifications')->dailyAt('01:35');


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
