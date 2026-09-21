<?php

namespace Database\Seeders;

use App\Models\Inventory_Item;
use Illuminate\Database\Seeder;

class InventoryItemSeeder extends Seeder
{
    public function run(): void
    {
        // Kitchen Area - Prepped Food

        $kitchenItems = [
            'Pork Sisig',
            'Chicken Sisig',
            'Pork Sisig NS',
            'Chicken Sisig NS',
            'Binagoongan',
            'C-Teriyaki',
            'Fish Fillet',
            'Bangus',
            'Pork Adobo',
            'Chicken Adobo',
            'Chicken Franks',
            'Pork/Chicken Tocino',
            'Corn Beef',
            'Pork/Chicken Ham',
            'Egg',
            'Baked Mac',
            'Mozzarella',
            'Fries',
            'Burger Patty',
            'Pork Chop',
            'Bihon',
            'C/K for Bihon',
            'Mixed Vegetables',
            'Pasta',
            'Chicken Carbonara',
            'Carbonara/Spaghetti Sauce',
            'Nachos Chips/Beef',
            'Cheese/Quickmelt',
            'Gravy',
            'Teriyaki/PorkChop Sauce',
            'Coke/Royal/Sprite',
        ];

        foreach ($kitchenItems as $item) {
            Inventory_Item::create([
                'unit_id' => null,
                'name' => $item,
                'inventory_type' => 'Prepped Food',
                'is_active' => true,
            ]);
        }

        // Bar Area - Ingredients

        $barItems = [
            'Vanilla',
            'Caramel',
            'Dark Chocolate',
            'Matcha',
            'Graham',
            'Crushed Oreo',
            'Cookies & Cream',
            'Strawberry',
            'Mango',
            'Ube',
            'Red Velvet',
            'Lemon Ice Tea',
            'Sauce - Caramel',
            'Sauce - Chocolate',
            'Sauce - Condensed Milk',
            'Puree - Strawberry',
            'Puree - Blueberry',
            'Puree - Mango',
        ];

        foreach ($barItems as $item) {
            Inventory_Item::create([
                'unit_id' => null,
                'name' => $item,
                'inventory_type' => 'Ingredient',
                'is_active' => true,
            ]);
        }
    }
}
