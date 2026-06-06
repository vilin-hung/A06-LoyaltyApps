<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Voucher;

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
        $user = User::create([
            'name' => 'Ipin',
            'email' => 'ipin@gmail.com',
            'password' => Hash::make('upinipin'),
            'role' => 'user',
            'saldo' => 1000000,
            'points' => 100,
        ]);
        // User::factory()->count(10)->create();

        // Product
       $product = Product::create([
            'name' => 'Kopi tes aja',
            'description' => 'enak banget si, rugi ga dicoba',
            'price' => '15000',
            'stock' => '40',
            'category' => 'beverages',
        ]);

        // Cart
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Transaction
        Transaction::create([
            'user_id' => $user->id,
            'voucher_id' => null,
            'total_amount' => 30000.00,
            'points_earned' => 1,
            'created_at' => now(),
        ]);
    }
}
