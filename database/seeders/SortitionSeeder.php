<?php

namespace Database\Seeders;

use App\Models\Sortition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SortitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = User::where('type', 'affiliate')->get();

        foreach ($vendors as $vendor) {
            Sortition::factory()->count(3)->create([
                'user_id' => $vendor->id
            ]);
        }
    }
}
