<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::where('email', 'barbie@gmail.com')->first();
        $user2 = User::where('email', 'ipin@gmail.com')->first();
        $product = Product::first();

        if ($user1 && $product) {
            Cart::create([
                'user_id' => $user1->id,
                'product_id' => $product->id,
                'quantity' => 2,
            ]);
        }

        if ($user2 && $product) {
            Cart::create([
                'user_id' => $user2->id,
                'product_id' => $product->id,
                'quantity' => 20,
            ]);
        }
    }
}
