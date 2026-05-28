<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class TransactionService
{
  public static function processOrder($userId, $items)
  {
    $user = \App\Models\User::findOrFail($userId);
    $total = 0;
    $itemsData = [];

    foreach ($items as $item) {
      $product = Product::findOrFail($item['product_id']);
      if ($product->stock < $item['quantity']) {
        throw new \Exception("Stok {$product->name} tidak cukup");
      }
      $subtotal = $product->price * $item['quantity'];
      $total += $subtotal;
      $itemsData[] = [
        'product' => $product,
        'quantity' => $item['quantity'],
        'price' => $product->price,
      ];
    }

    // Cek saldo user
    if ($user->balance < $total) {
      throw new \Exception("Saldo tidak cukup");
    }

    // Hitung poin berdasarkan tier
    $tier = self::getUserTier($user->total_spent);
    $multiplier = ($tier == 'Platinum') ? 2 : 1;
    $pointsEarned = floor($total / 30000) * $multiplier;

    DB::beginTransaction();
    try {
      // Mengurangi stok
      foreach ($itemsData as $data) {
        $data['product']->stock -= $data['quantity'];
        $data['product']->save();
      }

      // Update user
      $user->balance -= $total;
      $user->total_spent += $total;
      $user->points += $pointsEarned;
      $user->save();

      // Buat transaksi
      $transaction = Transaction::create([
        'user_id' => $user->id,
        'total_amount' => $total,
        'points_earned' => $pointsEarned,
      ]);

      // Simpan item transaksi
      foreach ($itemsData as $data) {
        TransactionItem::create([
          'transaction_id' => $transaction->id,
          'product_id' => $data['product']->id,
          'quantity' => $data['quantity'],
          'price' => $data['price'],
        ]);
      }

      DB::commit();
      return ['success' => true, 'points' => $pointsEarned, 'transaction' => $transaction];

    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  private static function getUserTier($totalSpent)
  {
    if ($totalSpent < 300000) return 'Silver';
    if ($totalSpent < 800000) return 'Gold';
    return 'Platinum';
  }
}