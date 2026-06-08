<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use App\Models\News;
use App\Models\Membership;

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

        $user = User::create([
            'name' => 'barbie',
            'email' => 'barbie@gmail.com',
            'password' => Hash::make('barbie28'),
            'role' => 'user',
            'saldo' => 500000,
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

        // Favorite
        // \App\Models\Favorite::create([
        //     'user_id' => $user->id,
        //     'product_id' => $product->id,
        // ]);

        // News
        News::create([
            'title' => 'Jam Buka Kedai Kopi Kita',
            'content' => 'Buka jam 7 pagi - 10 malam. Stay tuned!',
        ]);

        // Membership
       Membership::create([
            'level' => 'Silver',
            'min_transaction' => 0,
            'discount_percentage' => 0,
            'point_multiplier' => 1,
        ]);

        Membership::create([
            'level' => 'Gold',
            'min_transaction' => 300000,
            'discount_percentage' => 5,
            'point_multiplier' => 1,
        ]);

        Membership::create([
            'level' => 'Platinum',
            'min_transaction' => 800001,
            'discount_percentage' => 10,
            'point_multiplier' => 2,
        ]);

        $this->call([
            CartSeeder::class,
            TransactionSeeder::class,
        ]);
        
        // Voucher
        Voucher::create([
            'name' => 'Untuk Kamu 10 Ribu',
            'code' => 'HEMAT10K',
            'description' => 'Potongan langsung Rp 10.000 untuk kamu',
            'discount_type' => 'fixed',
            'discount_value' => 10000,
            'points_required' => 10,
            'quota' => 50,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'is_active' => true,
        ]);

        Voucher::create([
            'name' => 'Kopi Mantap untukmu',
            'code' => 'YangMantap',
            'description' => 'Potongan harga untuk kamu',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'points_required' => 25,
            'quota' => 50,
            'start_date' => now(),
            'end_date' => now()->addDays(21),
            'is_active' => true,
        ]);
    }
}
