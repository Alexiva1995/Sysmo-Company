<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\BonusPivot;
use App\Models\Wallet;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
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
        $schedule->call(function () {
            // DB::table('bonus_pivot')->delete();
            BonusPivot::create([
                'user_id' => random_int(1,26),
                'bonuses_id' => random_int(1,7),
                'status' => random_int(0,2),
                'bonus_date' => Carbon::now()
            ]);

            Wallet::create([
                'user_id' => random_int(1,26),
                'referred_id' => random_int(1,26),
                'amount' => random_int(1000,25000),
                'description' => 'Prueba random',
                'status' => random_int(0,2),
                'type_transaction' => random_int(1,2),
                'liquidated' => '0'            
            ]);
        })->everyMinute();        
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
