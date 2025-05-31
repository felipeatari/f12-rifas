<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sortition extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'slug',
        'price',
        'numbers_amount',
        'scheduled_at',
        'status',
        'image',
    ];

    public function numbers(): HasMany
    {
        return $this->hasMany(Number::class);
    }
}
