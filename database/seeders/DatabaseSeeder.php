<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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
        
        User::factory()->count(10)->create();

        // News
        News::create([
            'title' => 'Jam Buka Kedai Kopi Kita',
            'content' => 'Buka jam 7 pagi - 10 malam. Stay tuned!',
            'status' => true,
        ]);

        $this->call([
            UserSeeder::class,
            MembershipSeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
            VoucherSeeder::class,
            TransactionSeeder::class,
            CartSeeder::class,
            NewsSeeder::class,
        ]);
    }
}