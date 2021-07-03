<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProductWarehouseSeeder::class);
        $this->call(WalletSeeder::class);
        $this->call(LiquidactionSeeder::class);
        $this->call(LogLiquidactionSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(BonusSeeder::class);
    }
}
