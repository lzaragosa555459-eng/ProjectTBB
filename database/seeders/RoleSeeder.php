<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'Manager',
            'description' => 'Manages the business, sales, inventory, payments, and reports.',
        ]);

        Role::create([
            'name' => 'Cashier',
            'description' => 'Handles customer orders, payments, and the cash drawer.',
        ]);

        Role::create([
            'name' => 'Cook',
            'description' => 'Handles kitchen orders and inventory-related tasks.',
        ]);
    }
}
