<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

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

        // User biasa
        
        User::create([
            'name' => 'Ipin',
            'email' => 'ipin@gmail.com',
            'password' => Hash::make('upinipin'),
            'role' => 'user',
            'saldo' => 1000000,
            'points' => 100,
        ]);
        // User::factory()->count(10)->create();

        // Product
        Product::create([
            'name' => 'Kopi tes aja',
            'description' => 'enak banget si, rugi ga dicoba',
            'price' => '15000',
            'stock' => '40',
            'category' => 'beverages',
        ]);
    }
}
