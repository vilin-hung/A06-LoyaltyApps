<?php

namespace App\Services;

use App\Models\Membership;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;

class TransactionService
{
  public static function processOrder($userId, $items, $voucherId = null)
  {
    $user = \App\Models\User::findOrFail($userId);
    $subtotal = 0;
    $itemsData = [];

    // subtotal (harga produk bersih sebelum diskon)
    foreach ($items as $item) {
      $product = Product::findOrFail($item['product_id']);
      if ($product->stock < $item['quantity']) {
        throw new \Exception("Stok {$product->name} tidak cukup");
      }
      $itemSubtotal = $product->price * $item['quantity'];
      $subtotal += $itemSubtotal;
      $itemsData[] = [
        'product' => $product,
        'quantity' => $item['quantity'],
        'price' => $product->price,
      ];
    }

    // cek benefit dari tier
    $currentMembership = self::getUserTier($user->total_spent);
    $membershipDiscount = $subtotal * ($currentMembership->discount_percentage / 100);
    $totalAfterMembership = $subtotal - $membershipDiscount;

    // cek potongan voucher
    $voucherDiscount = 0;
    if ($voucherId) {
      $voucher = Voucher::findOrFail($voucherId);
      $voucherDiscount = $voucher->discount_amount ?? 0;
    }

    // grand total
    $finalAmount = $totalAfterMembership - $voucherDiscount;
    if ($finalAmount < 0) $finalAmount = 0; 

    // Cek saldo user
    if ($user->saldo < $finalAmount) {
      throw new \Exception('Saldo Anda tidak cukup untuk melakukan transaksi');
    }

    // Hitung poin berdasarkan tier
    $pointsEarned = floor($finalAmount / 30000) * $currentMembership->point_multiplier;

    DB::beginTransaction();
    try {
      // Mengurangi stok
      foreach ($itemsData as $data) {
        $data['product']->stock -= $data['quantity'];
        $data['product']->save();
      }

      // Update user
      $user->saldo -= $finalAmount;
      $user->total_spent += $finalAmount;
      $user->points += $pointsEarned;
      $newMembership = self::getUserTier($user->total_spent);
      $user->membership_id = $newMembership->id ?? null;
      $user->save();

      // Buat transaksi
      $transaction = Transaction::create([
        'user_id' => $user->id,
        'voucher_id' => $voucherId,
        'total_amount' => $finalAmount,
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
    $membership = Membership::where('min_transaction', '<=', $totalSpent)
      ->orderBy('min_transaction', 'desc')
      ->first();

    if(!$membership) {
      return(object) ['id' => 1, 'point_multiplier' => 1, 'discount_percentage' => 0];
    }

    return $membership;
  }
}