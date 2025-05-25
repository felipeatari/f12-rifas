<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Admin',
            'whatsapp' => '5599999999999',
            'type' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Vendedores (affiliates)
        User::factory(5)->create(['type' => 'affiliate']);

        // Clientes
        User::factory(20)->create([
            'type' => 'client',
            'password' => null,
            'remember_token' => null,
        ]);
    }
}
