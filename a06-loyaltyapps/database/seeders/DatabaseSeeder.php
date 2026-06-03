<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // User::factory()->count(10)->create();
    }
}
