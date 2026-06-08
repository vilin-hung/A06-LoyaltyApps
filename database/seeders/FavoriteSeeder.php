<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        Favorite::create([
            'user_id' => 1,
            'product_id' => 1,
        ]);
    }
}