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
    }
}
