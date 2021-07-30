<?php

namespace Database\Seeders;
use App\Models\Wallet;

use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    public function run()
    {
        // Generar Comisiones user
        for($i = 1; $i < 5; $i++){
            Wallet::create([
                'user_id' => 2,
                'bonus_id' => 4,
                'referred_id' => 1,
                'amount' => 50,
                'description' => 'Bono Directo por el usuario USUARIO',
                'status' => random_int(0,1),
                'type_transaction' => 0,
                'liquidated' => 0,
            ]);
        }
        for($i = 1; $i < 5; $i++){
            Wallet::create([
                'user_id' => 2,
                'bonus_id' => 4,
                'referred_id' => 1,
                'amount' => 70,
                'description' => 'Bono Directo por el usuario USUARIO',
                'status' => random_int(0,1),
                'type_transaction' => 0,
                'liquidated' => 0,
            ]);
        }
       

    }
}
