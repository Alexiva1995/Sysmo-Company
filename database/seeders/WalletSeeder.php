<?php

namespace Database\Seeders;
use App\Models\Wallet;

use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    public function run()
    {
        // Generar Liquidaciones user
        Wallet::create([
            'user_id' => '2',
            'referred_id' => '1',
            'debit' => '1500',
            'credit' => '500',
            'description' => 'PAGO NRO 1',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'user_id' => '2',
            'referred_id' => '1',
            'debit' => '2500',
            'credit' => '700',
            'description' => 'PAGO NRO 2',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'user_id' => '2',
            'referred_id' => '1',
            'debit' => '900',
            'credit' => '100',
            'description' => 'PAGO NRO 3',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        
        // Generar Liquidaciones Leonardo
        Wallet::create([
            'user_id' => '3',
            'referred_id' => '1',
            'debit' => '10000',
            'credit' => '1000',
            'description' => 'PAGO NRO 4',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'user_id' => '3',
            'referred_id' => '1',
            'debit' => '12000',
            'credit' => '1200',
            'description' => 'PAGO NRO 5',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);   
        
        // Generar Liquidaciones Alexis
        Wallet::create([
            'user_id' => '4',
            'referred_id' => '3',
            'debit' => '3500',
            'credit' => '350',
            'description' => 'PAGO NRO 6',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'user_id' => '4',
            'referred_id' => '3',
            'debit' => '',
            'credit' => '',
            'description' => 'PAGO NRO 7',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]); 
    }
}
