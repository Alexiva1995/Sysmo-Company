<?php

namespace Database\Seeders;
use App\Models\User;

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
            'role'=> '0',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '10000',
            'referred_id' => '3'
        ]);
        User::create([
            'firstname'=> 'Pedro',
            'lastname'=> 'Perez',
            'username'=> 'peperez',
            'email'=> 'peperez9911@gmail.com',
            'password'=> 'password',
            'role'=> '0',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '20000',
            'referred_id' => '3'
        ]);
    }
}