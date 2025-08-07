<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DemoCron::class,
        Commands\ProAffiliateTrnsaction::class,
        Commands\ProAffiliateTrnsaction::class,
        Commands\KycDocuments::class,
        Commands\Affilka::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('demo:cron')->everyMinute();
        $schedule->command('deposit:affiliate')->everyMinute();
        $schedule->command('pro:affiliate_transaction')->everyMinute();
        $schedule->command('kyc:cron')->everyMinute();
        $schedule->command('affilka:cron')->everyMinute(10);
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
