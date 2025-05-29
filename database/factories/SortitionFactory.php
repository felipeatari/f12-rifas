<?php

namespace Database\Factories;

use App\Models\Sortition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sortition>
 */
class SortitionFactory extends Factory
{
    protected $model = Sortition::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'title' => $title,
            'description' => $this->faker->paragraph,
            'slug' => Str::slug($title),
            'price' => $this->faker->randomFloat(2, 5, 50),
            'numbers_amount' => $this->faker->numberBetween(100, 500),
            'date' => $this->faker->dateTimeBetween('+1 days', '+30 days'),
            'status' => 'active',
            'image' => null,
        ];
    }
}
