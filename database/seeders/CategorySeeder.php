<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Coffee',
            'description' => 'Coffee-based beverages.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Non-Coffee',
            'description' => 'Non-coffee beverages.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Pastries',
            'description' => 'Pastries and baked products.',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Food',
            'description' => 'Food and meal items.',
            'is_active' => true,
        ]);
    }
}
