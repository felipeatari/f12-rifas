<?php

namespace Database\Seeders;

use App\Models\Number;
use App\Models\Sale;
use App\Models\Sortition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = User::where('type', 'client')->get();
        $sortitions = Sortition::all();

        foreach ($clients as $client) {
            $sortition = $sortitions->random();

            $availableNumbers = Number::where('sortition_id', $sortition->id)
                ->where('is_sold', false)
                ->inRandomOrder()
                ->limit(3)
                ->get();

            if ($availableNumbers->count() < 1) {
                continue;
            }

            $numbers = $availableNumbers->pluck('number')->toArray();

            // Marcar como vendidos
            foreach ($availableNumbers as $num) {
                $num->update(['is_sold' => true]);
            }

            Sale::create([
                'user_id' => $client->id,
                'sortition_id' => $sortition->id,
                'numbers' => json_encode($numbers),
                'total_numbers' => count($numbers),
                'unit_price' => $sortition->price,
                'total_price' => $sortition->price * count($numbers),
                'status' => 'paid'
            ]);
        }
    }
}
