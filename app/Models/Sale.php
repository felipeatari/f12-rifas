<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sortition_id',
        'numbers',
        'total_numbers',
        'unit_price',
        'total_price',
        'status',
    ];
}
