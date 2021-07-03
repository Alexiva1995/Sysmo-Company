<?php

namespace Database\Seeders;
use App\Models\Liquidaction;


use Illuminate\Database\Seeder;

class LiquidactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Liquidaction::create([
            'user_id' => '2',
            'total' => '1500',
            'gross_amount' => '1500',
            'feed' => '0',
            'hash' => 'retrtret23142',
            'status' => '1'
        ]);
        Liquidaction::create([
            'user_id' => '2',
            'total' => '2500',
            'gross_amount' => '2500',
            'feed' => '0',
            'status' => '2'
        ]);
        Liquidaction::create([
            'user_id' => '4',
            'total' => '0',
            'gross_amount' =>'0',
            'feed' => '0',
            'status' => '0'
        ]);
    }
}
