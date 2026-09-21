<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $manager = Role::where('name', 'Manager')->first();
        $cashier = Role::where('name', 'Cashier')->first();
        $cook = Role::where('name', 'Cook')->first();

        User::create([
            'role_id' => $manager->id,
            'name' => 'Test Manager',
            'email' => 'manager@thebrewingbar.test',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'role_id' => $cashier->id,
            'name' => 'Test Cashier',
            'email' => 'cashier@thebrewingbar.test',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'role_id' => $cook->id,
            'name' => 'Test Cook',
            'email' => 'cook@thebrewingbar.test',
            'password' => Hash::make('password'),
        ]);
    }
}
