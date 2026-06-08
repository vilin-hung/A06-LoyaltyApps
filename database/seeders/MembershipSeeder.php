<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
