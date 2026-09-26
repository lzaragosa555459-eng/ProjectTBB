<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory_Item;
use App\Models\Menu_Items;
use App\Models\Recipe_Items;
use Illuminate\Support\Facades\DB;

class InventoryItemController extends Controller
{
    public function index()
    {
        $items = Inventory_Item::with([
            'unit',
            'inventoryStocks.location',
        ])
            ->orderByDesc('is_active')
            ->orderBy('name')
            ->paginate(7);

        $activeItemCount = Inventory_Item::where('is_active', true)->count();

        $lowStockCount = \App\Models\Inventory_Stock::whereColumn(
            'current_quantity',
            '<=',
            'reorder_level'
        )->whereHas('inventoryItem', function ($query) {
            $query->where('is_active', true);
        })->count();

        return view('inventory.index', compact(
            'items',
            'activeItemCount',
            'lowStockCount'
        ));
    }
    public function toggleActive(Inventory_Item $inventoryItem)
    {
        DB::transaction(function () use ($inventoryItem) {
            $inventoryItem->is_active = !$inventoryItem->is_active;
            $inventoryItem->save();

            // When deactivating stock, make menu items using it unavailable.
            if (!$inventoryItem->is_active) {
                $menuItemIds = Recipe_Items::where(
                    'inventory_item_id',
                    $inventoryItem->id
                )
                    ->distinct()
                    ->pluck('menu_item_id');

                Menu_Items::whereIn('id', $menuItemIds)
                    ->update(['is_active' => false]);
            }
        });

        return redirect()
            ->route('inventory.index')
            ->with(
                'success',
                $inventoryItem->is_active
                    ? 'Inventory item activated.'
                    : 'Inventory item deactivated. Related menu items were marked inactive.'
            );
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory_Item $inventory_Item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory_Item $inventory_Item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory_Item $inventory_Item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory_Item $inventory_Item)
    {
        //
    }
}
