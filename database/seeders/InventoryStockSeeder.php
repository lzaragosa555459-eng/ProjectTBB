<?php

namespace Database\Seeders;

use App\Models\Inventory_Item;
use App\Models\Inventory_Locations;
use App\Models\Inventory_Stock;
use Illuminate\Database\Seeder;

class InventoryStockSeeder extends Seeder
{
    public function run(): void
    {
        $kitchen = Inventory_Locations::where('name', 'Kitchen Area')->first();
        $bar = Inventory_Locations::where('name', 'Bar Area')->first();

        // Kitchen Area
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

        foreach ($kitchenItems as $itemName) {
            $item = Inventory_Item::where('name', $itemName)->first();

            Inventory_Stock::create([
                'inventory_item_id' => $item->id,
                'location_id' => $kitchen->id,
                'current_quantity' => 0,
                'reorder_level' => 0,
            ]);
        }

        // Bar Area
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

        foreach ($barItems as $itemName) {
            $item = Inventory_Item::where('name', $itemName)->first();

            Inventory_Stock::create([
                'inventory_item_id' => $item->id,
                'location_id' => $bar->id,
                'current_quantity' => 0,
                'reorder_level' => 0,
            ]);
        }
    }
}
