<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i = 0; $i<40; $i++){
        //     Order::create([
        //         'user_id' => random_int(3,40),
        //         'product_id' => random_int(1,2),
        //         'amount' => 210,
        //         'status' => random_int(0,1),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }
        // for($i = 0; $i<40; $i++){
        //     Order::create([
        //         'user_id' => random_int(3,40),
        //         'product_id' => random_int(1,2),
        //         'amount' => 300,
        //         'status' => random_int(0,1),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }
    }
}
