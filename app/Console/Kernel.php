<?php

namespace App\Console;

use App\Models\Threshold;
use App\Models\Accumulate;
use Illuminate\Support\Carbon;
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
               Commands\WordOfTheDay::class

    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('WordOfTheDay:updateThreshold')->everyMinute();
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
