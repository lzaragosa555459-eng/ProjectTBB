<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu_Items;
use Illuminate\Database\Seeder;

class MenuItemsSeeder extends Seeder
{
    public function run(): void
    {
        $food = Category::where('name', 'Food')->first();

        Menu_Items::create([
            'category_id' => $food->id,
            'name' => 'Pork Sisig',
            'base_price' => 120,
            'description' => 'Pork sisig.',
            'is_active' => true,
        ]);

        Menu_Items::create([
            'category_id' => $food->id,
            'name' => 'Chicken Sisig',
            'base_price' => 120,
            'description' => 'Chicken sisig.',
            'is_active' => true,
        ]);

        Menu_Items::create([
            'category_id' => $food->id,
            'name' => 'Binagoongan',
            'base_price' => 130,
            'description' => 'Binagoongan.',
            'is_active' => true,
        ]);

        Menu_Items::create([
            'category_id' => $food->id,
            'name' => 'Fish Fillet',
            'base_price' => 130,
            'description' => 'Fish fillet.',
            'is_active' => true,
        ]);

        Menu_Items::create([
            'category_id' => $food->id,
            'name' => 'Pork Adobo',
            'base_price' => 120,
            'description' => 'Pork adobo.',
            'is_active' => true,
        ]);
    }
}
