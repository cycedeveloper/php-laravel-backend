<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{   

    protected $commands = [
        \spresnac\createcliuser\CreateCliUserCommand::class,
    ];
    
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('wallets:checksdeposits')->everyTwoMinutes();

        $schedule->command('stake:checkall')->everyTwoMinutes();

        $schedule->command('unverifedaccounts:clear')->everyTwoHours();

        $schedule->command('refresh:temps')->everySixHours();
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