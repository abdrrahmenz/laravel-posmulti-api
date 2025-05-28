<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role_id' => 1, // Assign a default role (e.g., 1 for "admin")
            'business_id' => 1, // Explicitly set business_id
            'outlet_id' => 1, // Add default outlet ID
        ]);
    }
}
