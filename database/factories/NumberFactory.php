<?php

namespace Database\Factories;

use App\Models\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

class NumberFactory extends Factory
{
    protected $model = Number::class;

    public function definition(): array
    {
        return [
            'sortition_id',
            'number',
            'is_old',
        ];
    }
}
