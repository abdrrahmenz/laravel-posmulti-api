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

        // 1. Create the role
        $role = Role::create([
            'id' => 1,
            'name' => 'Admin',
        ]);

        // 2. Create the business first (owner_id will be null initially)
        $business = Business::create([
            'id' => 1,
            'name' => 'Default Business',
            'owner_id' => null, // Will update this later
        ]);

        // 3. Create an outlet with the business
        $outlet = Outlet::create([
            'id' => 1,
            'name' => 'Default Outlet',
            'address' => 'Default Address',
            'business_id' => $business->id
        ]);

        // 4. Create user with business_id and outlet_id
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
            'business_id' => $business->id,
            'outlet_id' => $outlet->id,
        ]);

        // 5. Update the business with the owner_id
        $business->update([
            'owner_id' => $user->id,
        ]);

        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
