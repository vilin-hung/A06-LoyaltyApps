<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'voucher_id',
        'subtotal',
        'voucher_discount',
        'membership_discount',
        'total_amount',
        'points_earned'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function items() {
        return $this->hasMany(TransactionItem::class);
    }
 
    public function transactionItems() {
        return $this->hasMany(TransactionItem::class, 'transaction_id');
    }
    
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
}
