<?php

namespace App\Http\Controllers;

use App\Models\Menu_Items;

class POSController extends Controller
{
    public function index()
    {
        $menuItems = Menu_Items::with([
            'optionGroups.optionValues',
            'recipeItems.inventoryItem.inventoryStocks',
        ])
            ->where('is_active', true)
            ->orderBy('name')
            ->paginate(6);

        return view('pos.index', compact('menuItems'));
    }
}
