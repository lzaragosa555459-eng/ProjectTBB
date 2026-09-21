<?php

namespace Database\Seeders;

use App\Models\Option_Values;
use App\Models\Option_Groups;
use Illuminate\Database\Seeder;

class OptionValuesSeeder extends Seeder
{
    public function run(): void
    {
        $temperature = Option_Groups::where('name', 'Temperature')->first();
        $flavor = Option_Groups::where('name', 'Flavor')->first();

        Option_Values::create([
            'option_group_id' => $temperature->id,
            'name' => 'Hot',
            'price_adjustment' => 0,
            'is_active' => true,
        ]);

        Option_Values::create([
            'option_group_id' => $temperature->id,
            'name' => 'Iced',
            'price_adjustment' => 0,
            'is_active' => true,
        ]);

        Option_Values::create([
            'option_group_id' => $flavor->id,
            'name' => 'Vanilla',
            'price_adjustment' => 0,
            'is_active' => true,
        ]);

        Option_Values::create([
            'option_group_id' => $flavor->id,
            'name' => 'Caramel',
            'price_adjustment' => 0,
            'is_active' => true,
        ]);

        Option_Values::create([
            'option_group_id' => $flavor->id,
            'name' => 'Hazelnut',
            'price_adjustment' => 0,
            'is_active' => true,
        ]);
    }
}
