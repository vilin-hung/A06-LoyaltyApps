<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
    'name', 
    'code', 
    'description', 
    'points_required', 
    'discount_type', 
    'discount_value', 
    'quota', 
    'start_date', 
    'end_date', 
    'is_active'
  ];

  protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];
}
