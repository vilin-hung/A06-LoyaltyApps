<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redeem;

class RedeemSeeder extends Seeder
{
    public function run(): void
    {
        Redeem::create([
            'user_id' => 1,
            'voucher_id' => 1,
            'points_spent' => 100
        ]);
    }
}