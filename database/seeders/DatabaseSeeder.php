<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Business;
use App\Models\Outlet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Temporarily disable foreign key constraints
        Schema::disableForeignKeyConstraints();
        
        // Create a role first
        Role::create([
            'id' => 1,
            'name' => 'Admin',
        ]);

        // Create initial user without business_id and outlet_id
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            // No business_id or outlet_id yet
        ]);

        // Create a business with the user as owner
        $business = Business::create([
            'id' => 1,
            'name' => 'Default Business',
            'owner_id' => $user->id,
        ]);

        // Create an outlet
        Outlet::create([
            'id' => 1,
            'name' => 'Default Outlet',
            'address' => 'Default Address',
            'business_id' => $business->id
        ]);

        // Update the user with business_id and outlet_id
        if (Schema::hasColumn('users', 'business_id')) {
            $user->update([
                'business_id' => $business->id,
                'outlet_id' => 1,
            ]);
        }

        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
