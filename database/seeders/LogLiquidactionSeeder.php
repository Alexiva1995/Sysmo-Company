<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogLiquidation;

class LogLiquidactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LogLiquidation::create([
            'liquidation_id' => '2',
            'commentary' => 'reversar',
            'action' => 'Reversada',            
        ]);
    }
}
