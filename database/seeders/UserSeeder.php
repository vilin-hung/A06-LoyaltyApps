<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Mimin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
            'saldo' => 0,
            'points' => 0,
        ]);

        // User 
          User::create([
            'name' => 'Ipin',
            'email' => 'ipin@gmail.com',
            'password' => Hash::make('upinipin'),
            'role' => 'user',
            'saldo' => 1000000,
            'points' => 100,
        ]);

        User::create([
            'name' => 'barbie',
            'email' => 'barbie@gmail.com',
            'password' => Hash::make('barbie28'),
            'role' => 'user',
            'saldo' => 500000,
            'points' => 100,
        ]);
        
        User::create([
            'name' => 'SpongeBob SquarePants',
            'email' => 'spongebob@gmail.com',
            'password' => Hash::make('sponge123'),
            'role' => 'user',
            'saldo' => 50000,
            'points' => 10,
        ]);

        User::create([
            'name' => 'Patrick Star',
            'email' => 'patrick@gmail.com',
            'password' => Hash::make('patrickganteng'),
            'role' => 'user',
            'saldo' => 30000,
            'points' => 5,
        ]);

        User::create([
            'name' => 'Squidward Tentacles',
            'email' => 'squidward@gmail.com',
            'password' => Hash::make('cintakuklarinet'),
            'role' => 'user',
            'saldo' => 100000,
            'points' => 20,
        ]);

        User::create([
            'name' => 'Eugene H. Krabs',
            'email' => 'krab@gmail.com',
            'password' => Hash::make('uangkusegalanya'),
            'role' => 'user',
            'saldo' => 1000000,
            'points' => 100,
        ]);

        User::create([
            'name' => 'Sandy Cheeks',
            'email' => 'sandy@gmail.com',
            'password' => Hash::make('ilmuangila'),
            'role' => 'user',
            'saldo' => 75000,
            'points' => 15,
        ]);
    }
}