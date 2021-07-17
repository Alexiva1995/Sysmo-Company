<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname'=> 'admin',
            'username'=> 'admin',
            'email'=> 'admin@email.com',
            'password'=> 'password',
            'billetera' => '$*$*BILLETERA-Admin*$*$*$',
            'role'=> '1',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '1500',
        ]);
        User::create([
            'firstname'=> 'usuario',
            'username'=> 'user',
            'email'=> 'user@email.com',
            'password'=> 'password',
            'billetera' => '$*$*BILLETERA-User*$*$*$',
            'role'=> '0',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '20000',
            'referred_id' => '1'
        ]);
        User::create([
            'firstname'=> 'Leonardo',
            'lastname'=> 'Guilarte',
            'username'=> 'leomiguel',
            'email'=> 'leomiguel@valdusoft.com',
            'password'=> '123456',
            'billetera' => '$*$*BILLETERA-Leonardo*$*$*$',
            'role'=> '1',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '15000',
            'referred_id' => '1'
        ]);
        User::create([
            'firstname'=> 'Alexis',
            'lastname'=> 'Valera',
            'username'=> 'alexis95',
            'email'=> 'alexisvalera@valdusoft.com',
            'password'=> '123456',
            'billetera' => '$*$*BILLETERA-Alexis*$*$*$',
            'role'=> '0',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '10000',
            'referred_id' => '3'
        ]);
        User::create([
            'firstname'=> 'Eulin',
            'lastname'=> 'Palma',
            'username'=> 'eulinp',
            'email'=> 'eulinpr@gmail.com',
            'password'=> '12345678',
            'billetera' => '$*$*BILLETERA-Eulin*$*$*$',
            'role'=> '0',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '30000',
            'referred_id' => '3'
        ]);

        //Usuarios de prueba para los Bonos
        for($i = 0; $i<20; $i++){
            User::create([
                'firstname'=> Str::random(5),
                'lastname'=> Str::random(5),
                'username'=> Str::random(5),
                'email'=> Str::random(5).'@gmail.com',
                'password'=> '12345678',
                'billetera' => '$*$*BILLETERA-'.Str::random(5).'*$*$*$',
                'role'=> '0',
                'range_id'=> '0',
                'status'=> '1',
                'balance'=> '30000',
                'referred_id' => random_int(1,6)
            ]);
        }
    }
}