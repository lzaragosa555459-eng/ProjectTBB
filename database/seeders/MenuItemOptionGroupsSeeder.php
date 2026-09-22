<?php

namespace Database\Seeders;

use App\Models\Menu_Items;
use App\Models\Option_Groups;
use App\Models\Menu_Item_Option_Groups;
use Illuminate\Database\Seeder;

class MenuItemOptionGroupsSeeder extends Seeder
{
    public function run(): void
    {
        $temperature = Option_Groups::where('name', 'Temperature')->first();
        $flavor = Option_Groups::where('name', 'Flavor')->first();
        $size = Option_Groups::where('name', 'Size')->first();

        $latte = Menu_Items::where('name', 'Latte')->first();
        $caramelLatte = Menu_Items::where('name', 'Caramel Latte')->first();
        $matchaLatte = Menu_Items::where('name', 'Matcha Latte')->first();


        // Latte

        Menu_Item_Option_Groups::create([
            'menu_item_id' => $latte->id,
            'option_group_id' => $temperature->id,
            'is_required' => true,
        ]);

        Menu_Item_Option_Groups::create([
            'menu_item_id' => $latte->id,
            'option_group_id' => $flavor->id,
            'is_required' => false,
        ]);

        Menu_Item_Option_Groups::create([
            'menu_item_id' => $latte->id,
            'option_group_id' => $size->id,
            'is_required' => true,
        ]);


        // Caramel Latte

        Menu_Item_Option_Groups::create([
            'menu_item_id' => $caramelLatte->id,
            'option_group_id' => $temperature->id,
            'is_required' => true,
        ]);

        Menu_Item_Option_Groups::create([
            'menu_item_id' => $caramelLatte->id,
            'option_group_id' => $size->id,
            'is_required' => true,
        ]);


        // Matcha Latte

        Menu_Item_Option_Groups::create([
            'menu_item_id' => $matchaLatte->id,
            'option_group_id' => $temperature->id,
            'is_required' => true,
        ]);

        Menu_Item_Option_Groups::create([
            'menu_item_id' => $matchaLatte->id,
            'option_group_id' => $size->id,
            'is_required' => true,
        ]);
    }
}
