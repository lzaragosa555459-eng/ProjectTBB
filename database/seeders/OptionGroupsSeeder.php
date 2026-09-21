<?php

namespace Database\Seeders;

use App\Models\Option_Groups;
use Illuminate\Database\Seeder;

class OptionGroupsSeeder extends Seeder
{
    public function run(): void
    {
        Option_Groups::create([
            'name' => 'Temperature',
            'description' => 'Temperature options for beverages.',
        ]);

        Option_Groups::create([
            'name' => 'Flavor',
            'description' => 'Flavor options for beverages.',
        ]);
    }
}
