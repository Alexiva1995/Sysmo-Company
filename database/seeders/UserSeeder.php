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
            'firstname'=> 'usuario',
            'lastname'=> 'user',
            'username'=> 'user',
            'email'=> 'user@email.com',
            'password'=> 'password',
            'role'=> '0',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '1500',
        ]);
        User::create([
            'firstname'=> 'administrator',
            'lastname'=> 'admin',
            'username'=> 'admin',
            'email'=> 'admin@email.com',
            'password'=> 'password',
            'role'=> '1',
            'range_id'=> '0',
            'status'=> '1',
            'balance'=> '1500',
        ]);
    }
}