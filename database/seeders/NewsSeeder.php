<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::create([
            'title' => 'Jam Buka Kedai Kopi Kita',
            'content' => 'Buka jam 7 pagi - 10 malam setiap hari. Stay tuned!',
            'status' => true,
        ]);

        News::create([
            'title' => 'Promo Spesial: Hemat Rp 10 Ribu!',
            'content' => 'Gunakan kode HEMAT10K untuk diskon langsung Rp 10.000. Minimal transaksi Rp 50.000. Promo berlaku 30 hari!',
            'status' => true,
        ]);

        News::create([
            'title' => 'Yuk Gabung Membership!',
            'content' => 'Nikmati diskon 5% untuk Gold Member dan 10% untuk Platinum Member. Semakin banyak belanja, semakin banyak diskon!',
            'status' => true,
        ]);
    }
}