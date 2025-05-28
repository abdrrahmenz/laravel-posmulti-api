<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Business;
use App\Models\Outlet;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a role first
        Role::create([
            'id' => 1,
            'name' => 'Admin',
        ]);

        // Create a business
        Business::create([
            'id' => 1,
            'name' => 'Default Business',
            'address' => 'Default Address',
            'phone' => '123456789'
        ]);

        // Create an outlet
        Outlet::create([
            'id' => 1,
            'name' => 'Default Outlet',
            'address' => 'Default Address',
            'business_id' => 1
        ]);

        // Now create the user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role_id' => 1, // Now this role exists
            'business_id' => 1, // Now this business exists
            'outlet_id' => 1, // Now this outlet exists
        ]);
    }
}
