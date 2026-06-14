<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            'is_active' => false,
        ]);

        Voucher::create([
            'name' => 'Haus Kasih Sayang (& Kopi)',
            'code' => 'FORYOU<3',
            'description' => 'untuk kamu yang lagi haus kasih sayang dan kopi',
            'discount_type' => 'fixed',
            'discount_value' => 7000,
            'points_required' => 15,
            'quota' => 45,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'is_active' => true,
        ]);

        Voucher::create([
            'name' => 'Kemerdekaan Indonesia',
            'code' => 'RI26',
            'description' => 'Potongan harga untuk merayakan hari kemerdekaan Indonesia',
            'discount_type' => 'fixed',
            'discount_value' => 10000,
            'points_required' => 5,
            'quota' => 45,
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'is_active' => false,
        ]);

        Voucher::create([
            'name' => 'Kopi Mantap untukmu',
            'code' => 'YangMantap',
            'description' => 'Potongan harga untuk kamu',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'points_required' => 7,
            'quota' => 50,
            'start_date' => now(),
            'end_date' => now()->addDays(21),
            'is_active' => true,
        ]);

        Voucher::create([
            'name' => 'Dana Darurat Kopi',
            'code' => 'Kopi123',
            'description' => 'Potongan harga untuk kamu yang butuh kopi, tapi danamu lagi menipis',
            'discount_type' => 'fixed',
            'discount_value' => 15000,
            'points_required' => 25,
            'quota' => 30,
            'start_date' => now(),
            'end_date' => now()->addDays(21),
            'is_active' => true,
        ]);

        Voucher::create([
            'name' => 'Ku Cinta Kopi',
            'code' => 'Ilike123',
            'description' => 'Potongan harga untuk kamu para pecinta kopi',
            'discount_type' => 'percentage',
            'discount_value' => 5,
            'points_required' => 10,
            'quota' => 65,
            'start_date' => now(),
            'end_date' => now()->addDays(21),
            'is_active' => false,
        ]);

        Voucher::create([
            'name' => 'Demi Konten',
            'code' => 'Konten2026',
            'description' => 'Voucher belanja buat barang-barang yang dibeli cuma demi estetika medsos',
            'discount_type' => 'percentage',
            'discount_value' => 5,
            'points_required' => 15,
            'quota' => 50,
            'start_date' => now(),
            'end_date' => now()->addDays(45),
            'is_active' => false,
        ]);

        Voucher::create([
            'name' => 'Tumbal Kuota',
            'code' => 'KAGETBGT',
            'description' => 'Voucher yang kuotanya terbatas banget dan cepat habis',
            'discount_type' => 'fixed',
            'discount_value' => 12000,
            'points_required' => 15,
            'quota' => 10,
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'is_active' => false,
        ]);

        Voucher::create([
            'name' => 'Secangkir Jeda',
            'code' => 'LelahBanget',
            'description' => 'Potongan harga untuk kamu yang lagi kelelahan menghadapi hari-hari yang berat',
            'discount_type' => 'percentage',
            'discount_value' => 5,
            'points_required' => 15,
            'quota' => 40,
            'start_date' => now(),
            'end_date' => now()->addDays(21),
            'is_active' => true,
        ]);

        Voucher::create([
            'name' => 'Voucher Rahasia',
            'code' => 'RAHASIA2026',
            'description' => 'Voucher yang hanya bisa didapatkan oleh pengguna tertentu saja',
            'discount_type' => 'fixed',
            'discount_value' => 5000,
            'points_required' => 12,
            'quota' => 20,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'is_active' => true,
        ]);

        Voucher::create([
            'name' => 'Voucher Spesial',
            'code' => 'SPESIAL2026',
            'description' => 'Voucher dengan potongan harga spesial untuk pengguna setia',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'points_required' => 20,
            'quota' => 30,
            'start_date' => now(),
            'end_date' => now()->addDays(60),
            'is_active' => true,
        ]);

        Voucher::create([
            'name' => 'A Little Treat for You',
            'code' => 'URSPECIAL',
            'description' => 'Untuk kalian yang sedang berulang tahun',
            'discount_type' => 'percentage',
            'discount_value' => 50,
            'points_required' => 20,
            'quota' => 20,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'is_active' => false,
        ]);
    }
}
