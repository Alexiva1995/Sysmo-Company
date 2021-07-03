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
            'balance' => '1500',
            'credit' => '0',
            'description' => 'PAGO NRO 1',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0',
            'liquidation_id' => '1'
        ]);
        Wallet::create([
            'user_id' => '2',
            'referred_id' => '1',
            'debit' => '2500',
            'balance' => '2500',
            'credit' => '0',
            'description' => "PAGO NRO 2",
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'user_id' => '2',
            'referred_id' => '1',
            'debit' => '900',
            'balance' => '900',
            'credit' => '0',
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
            'balance' => '10000',
            'credit' => '0',
            'description' => 'PAGO NRO 4',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'user_id' => '3',
            'referred_id' => '1',
            'debit' => '12000',
            'balance' => '12000',
            'credit' => '0',
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
            'balance' => '3500',
            'credit' => '0',
            'description' => 'PAGO NRO 6',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'user_id' => '4',
            'referred_id' => '3',
            'debit' => '15000',
            'balance' => '15000',
            'credit' => '',
            'description' => 'PAGO NRO 7',
            'status' => '1',
            'type_transaction' => '0',
            'liquidated' => '0',
            'liquidation_id' => '3'            
        ]); 

        // Liquidaciones
        Wallet::create([
            'user_id' => '2',
            'referred_id' => '1',
            'debit' => '0',
            'credit' => '1500',
            'balance' => '-1500',
            'description' => 'Liquidacion del usuario user por un monto de 1500',
            'status' => '0',
            'type_transaction' => '1',
            'liquidated' => '0'            
        ]); 
        Wallet::create([
            'user_id' => '2',
            'referred_id' => '1',
            'debit' => '0',
            'credit' => '2500',
            'balance' => '-2500',
            'description' => 'Liquidacion del usuario user por un monto de 2500',
            'status' => '0',
            'type_transaction' => '1',
            'liquidated' => '0'            
        ]); 
        Wallet::create([
            'user_id' => '2',
            'referred_id' => '1',
            'debit' => '0',
            'credit' => '2500',
            'balance' => '-2500',
            'description' => 'Liquidacion Reservada - Motivo: reversar',
            'status' => '1',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]); 
        Wallet::create([
            'user_id' => '4',
            'referred_id' => '3',
            'debit' => '0',
            'credit' => '15000',
            'balance' => '-15000',
            'description' => 'Liquidacion del usuario alexis95 por un monto de 15000',
            'status' => '0',
            'type_transaction' => '1',
            'liquidated' => '0'            
        ]);
    }
}
