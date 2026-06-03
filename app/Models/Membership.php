<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'level', 
        'min_transaction', 
        'point_multiplier', 
        'discount_percentage', 
        'description'
    ];
}
