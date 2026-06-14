<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'user_id' => 2,
            'product_id' => 1,
            'rating' => 5,
            'comment' => 'Kopinya enak banget, aromanya kuat dan gak terlalu pahit!'
        ]);

        Review::create([
            'user_id' => 6,
            'product_id' => 1,
            'rating' => 4,
            'comment' => 'Rasa kopi nya sangat nikmat sehingga membuat jatuh cinta!!'
        ]);

        Review::create([
            'user_id' => 2,
            'product_id' => 10,
            'rating' => 3,
            'comment' => 'Cocok lah buat bikin mata melek.'
        ]);

        Review::create([
            'user_id' => 3,
            'product_id' => 2,
            'rating' => 4,
            'comment' => 'Rasa kopi nya diluar ekspektasi looks nya soft tapi ternyata rasanya strong banget' 
        ]);

        Review::create([
            'user_id' => 4,
            'product_id' => 3,
            'rating' => 3,
            'comment' => 'Kopinya bikin kita berterimakasih kepada hidup'
        ]);

        Review::create([
            'user_id' => 4,
            'product_id' => 4,
            'rating' => 5,
            'comment' => 'Enak banget, cocok buat ga terlalu suka kopi yang kuat'
        ]);

        Review::create([
            'user_id' => 5,
            'product_id' => 5,
            'rating' => 4,
            'comment' => 'Kopinya bener bener bikin bangun'
        ]);

        Review::create([
            'user_id' => 3,
            'product_id' => 6,
            'rating' => 5,
            'comment' => 'Enak banget, my style banget nii!'
        ]);

        Review::create([
            'user_id' => 3,
            'product_id' => 7,
            'rating' => 4,
            'comment' => 'Rasa kopinya enak ga nutupin rasa alpukat nya so yummy'
        ]);

        Review::create([
            'user_id' => 5,
            'product_id' => 8,
            'rating' => 5,
            'comment' => 'Rasa matcha nya enak banget ga kaleng kaleng'
        ]);

        Review::create([
            'user_id' => 5,
            'product_id' => 9,
            'rating' => 5,
            'comment' => 'Rasa teh nya ga murahan bener bener bisa dinikmati buat semua kalangan usia.'
        ]);

        Review::create([
            'user_id' => 2,
            'product_id' => 10,
            'rating' => 4,
            'comment' => 'Feel nenangin nya dapet banget, aku suka cocok buat orang yang lagi cape habis kerja' 
        ]);

        Review::create([
            'user_id' => 6,
            'product_id' => 11,
            'rating' => 5,
            'comment' => 'Ga ekspek dapet leci aslinya wehh, suka bangett!!!!' 
        ]);

        Review::create([
            'user_id' => 5,
            'product_id' => 12,
            'rating' => 3,
            'comment' => 'Rasanya bener bener cocok buat anak anak'
        ]);

        Review::create([
            'user_id' => 2,
            'product_id' => 13,
            'rating' => 5,
            'comment' => 'AKU SUKA BANGET BOBA NYA BANYAK, MANISNYA JUGA PAS GA KEMANISAN GITU' 
        ]);

        Review::create([
            'user_id' => 2,
            'product_id' => 14,
            'rating' => 4,
            'comment' => 'Rasanya mirip banget sama yang aku coba di Thailand, bener bener yummy'
        ]);

        Review::create([
            'user_id' => 4,
            'product_id' => 15,
            'rating' => 4,
            'comment' => 'Wangi vanilla nya wangi banget tapi ga ngeganggu sama sekali dan bikin jadi tambah enak, i like itt'
        ]);

        Review::create([
            'user_id' => 3,
            'product_id' => 16,
            'rating' => 4,
            'comment' => 'Walaupun brown sugar nya banyak tapi manis nya pas dan rasanya tetep balance' 
        ]);

        Review::create([
            'user_id' => 6,
            'product_id' => 17,
            'rating' => 4,
            'comment' => 'Taro nya berasa tapi ga too much, suka bangett' 
        ]);

        Review::create([
            'user_id' => 5,
            'product_id' => 18,
            'rating' => 4,
            'comment' => 'RASA COKLATNYA ENAK BANGET WOI BENER BENER BIKIN KECANDUAN' 
        ]);

        Review::create([
            'user_id' => 5,
            'product_id' => 19,
            'rating' => 3,
            'comment' => 'Ini my type banget Chocolate nya pakai dark chocolate jadi ga kemanisan'
        ]);

        Review::create([
            'user_id' => 2,
            'product_id' => 20,
            'rating' => 4,
            'comment' => 'Walaupun ini minuman coklat tapi bikin melek pas kerjain Algemath guyss, sangat recommended'
        ]);

        Review::create([
            'user_id' => 3,
            'product_id' => 21,
            'rating' => 2,
            'comment' => 'Sebenernya rasanya enak banget cuma menurut aku terlalu panas'
        ]);
    }
}
