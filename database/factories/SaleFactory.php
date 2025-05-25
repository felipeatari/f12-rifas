<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'user_id',
            'sortition_id',
            'numbers',
            'total_numbers',
            'unit_price',
            'total_price',
            'status',
        ];
    }
}
