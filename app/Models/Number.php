<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Number extends Model
{
    use HasFactory;

    protected $fillable = [
        'sortition_id',
        'number',
        'number_str',
        'is_old',
    ];

    public function sortition(): BelongsTo
    {
        return $this->belongsTo(Sortition::class);
    }
}
