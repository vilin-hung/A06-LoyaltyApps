<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::where('email', 'barbie@gmail.com')->first();

        if ($user1) {
            Transaction::create([
                'user_id' => $user1->id,
                'voucher_id' => null,
                'subtotal' => 30000.00,
                'voucher_discount' => 0.00,  
                'membership_discount' => 0.00,
                'total_amount' => 30000.00,
                'points_earned' => 1,
                'created_at' => now(),
            ]);

            Transaction::create([
                'user_id' => $user1->id,
                'voucher_id' => null,
                'subtotal' => 100000.00,
                'voucher_discount' => 0.00,  
                'membership_discount' => 0.00,
                'total_amount' => 100000.00,
                'points_earned' => 3,
                'created_at' => now(),
            ]);
        }
    }
}
