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
            'bonus_id' => '1',
            'user_id' => '2',
            'referred_id' => '1',
            'amount' => '1500',
            'description' => 'PAGO NRO 1',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0',
            'liquidation_id' => '1'
        ]);
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '2',
            'referred_id' => '1',
            'amount' => '2500',
            'description' => "PAGO NRO 2",
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '2',
            'referred_id' => '1',
            'amount' => '900',
            'description' => 'PAGO NRO 3',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        
        // Generar Liquidaciones Leonardo
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '3',
            'referred_id' => '1',
            'amount' => '10000',
            'description' => 'PAGO NRO 4',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '3',
            'referred_id' => '1',
            'amount' => '12000',
            'description' => 'PAGO NRO 5',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);   
        
        // Generar Liquidaciones Alexis
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '4',
            'referred_id' => '3',
            'amount' => '3500',
            'description' => 'PAGO NRO 6',
            'status' => '0',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]);
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '4',
            'referred_id' => '3',
            'amount' => '15000',
            'description' => 'PAGO NRO 7',
            'status' => '1',
            'type_transaction' => '0',
            'liquidated' => '0',
            'liquidation_id' => '3'            
        ]); 

        // Liquidaciones
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '2',
            'amount' => '1500',
            'referred_id' => '1',
            'description' => 'Liquidacion del usuario user por un monto de 1500',
            'status' => '0',
            'type_transaction' => '1',
            'liquidated' => '0'            
        ]); 
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '2',
            'amount' => '2500',
            'referred_id' => '1',
            'description' => 'Liquidacion del usuario user por un monto de 2500',
            'status' => '0',
            'type_transaction' => '1',
            'liquidated' => '0'            
        ]); 
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '2',
            'amount' => '2500',
            'referred_id' => '1',
            'description' => 'Liquidacion Reservada - Motivo: reversar',
            'status' => '1',
            'type_transaction' => '0',
            'liquidated' => '0'            
        ]); 
        Wallet::create([
            'bonus_id' => '1',
            'user_id' => '4',
            'referred_id' => '3',
            'amount' => '15000',
            'description' => 'Liquidacion del usuario alexis95 por un monto de 15000',
            'status' => '0',
            'type_transaction' => '1',
            'liquidated' => '0'            
        ]);
    }
}
