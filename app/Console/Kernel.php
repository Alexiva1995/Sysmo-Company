<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\BonusPivot;
use App\Models\Wallet;
use App\Traits\BonoTrait;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    use BonoTrait;
    protected $commands = [
        Commands\BonoCarLifeStyle::class,
        Commands\BonoMotorBike::class,
        Commands\BonoTravel::class,
        Commands\BonoSpeed::class,
        Commands\BonoStart::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('bono:carlifestyle')->everyMinute();
        $schedule->command('bono:motorbike')->everyMinute();
        $schedule->command('bono:travel')->everyMinute();
        $schedule->command('bono:speed')->everyMinute();
        $schedule->command('bono:start')->everyMinute();
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
