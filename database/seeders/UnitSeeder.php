<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        Unit::create([
            'name' => 'Kilogram',
            'abbreviation' => 'kg',
        ]);

        Unit::create([
            'name' => 'Gram',
            'abbreviation' => 'g',
        ]);

        Unit::create([
            'name' => 'Liter',
            'abbreviation' => 'L',
        ]);

        Unit::create([
            'name' => 'Milliliter',
            'abbreviation' => 'ml',
        ]);

        Unit::create([
            'name' => 'Piece',
            'abbreviation' => 'pc',
        ]);

        Unit::create([
            'name' => 'Bottle',
            'abbreviation' => 'btl',
        ]);
    }
}
