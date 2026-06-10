<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $fillable = [
        'user_id',
        'voucher_id',
        'points_spent',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}

