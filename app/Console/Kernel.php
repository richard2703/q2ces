<?php

namespace App\Console;

use App\Jobs\GenerarDiasFeriadosJob;
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
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('demo:cron')->everyFiveMinutes();
        // $schedule->command('test:cron')->everyMinute();
        // $schedule->command('cumple:cron')->everyFiveMinutes();

        $schedule->command('demo:cron')
            ->yearly()
            ->on('01-01')
            ->at('00:00');

        $schedule->command('cumple:cron')
            ->monthlyOn(1, '00:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
