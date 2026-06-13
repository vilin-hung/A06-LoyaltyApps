<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionItem;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionsData = [
            [   
                'user_id' => 2,
                'items' => [
                    [
                        'product_id' => 20,
                        'quantity' => 10,
                        'price' => 30900,
                    ]
                ],
                'subtotal' => (9*30900),
                'total_amount' => 278100,
                'points_earned' => 9,
            ],

            [   
                'user_id' => 2,
                'items' => [
                    [
                        'product_id' => 6,
                        'quantity' => 1,
                        'price' => 45000,
                    ],
                    [
                        'product_id' => 8,
                        'quantity' => 1,
                        'price' => 43000,
                    ],
                ],
                'subtotal' => (45000 + 43000),
                'total_amount' => 88000,
                'points_earned' => 2,  
            ],

            [   
                'user_id' => 4,
                'items' => [
                    [
                        'product_id' => 9,
                        'quantity' => 4,
                        'price' => 29900,
                    ]
                ],
                'subtotal' => (4*29900),
                'total_amount' => 119600,
                'points_earned' => 3, 
            ],

            [   
                'user_id' => 6,
                'items' => [
                    [
                        'product_id' => 11,
                        'quantity' => 5,
                        'price' => 32900,
                    ]
                ],
                'subtotal' => (5*32900),
                'total_amount' => 164500,
                'points_earned' => 5, 
            ],

            [   
                'user_id' => 8,
                'items' => [
                    [
                        'product_id' => 16,
                        'quantity' => 4,
                        'price' => 45900,
                    ]
                ],
                'subtotal' => (4*45900),
                'total_amount' => 183600,
                'points_earned' => 6, 
            ],
        ];

        foreach($transactionsData as $data) {
            $transaction = Transaction::create([
                'user_id' => $data['user_id'],
                'voucher_id' => null,
                'subtotal' => $data['subtotal'],
                'voucher_discount' => 0,
                'membership_discount' => 0,
                'total_amount' => $data['total_amount'],
                'points_earned' => $data['points_earned'],
                'created_at' => now(),
            ]);

            foreach($data['items'] as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        }
    }
}
