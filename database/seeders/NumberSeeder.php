<?php

namespace Database\Seeders;

use App\Models\Number;
use App\Models\Sortition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sortitions = Sortition::all();

        foreach ($sortitions as $sortition) {
            for ($i = 1; $i <= $sortition->numbers_amount; $i++) {
                Number::create([
                    'sortition_id' => $sortition->id,
                    'number' => $i,
                    'number_str' => str_pad($i, strlen((string) $sortition->numbers_amount), '0', STR_PAD_LEFT),
                    'is_sold' => false
                ]);
            }
        }
    }
}
