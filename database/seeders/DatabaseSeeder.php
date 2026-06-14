<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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
