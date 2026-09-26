<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory_Item;

class InventoryItemController extends Controller
{
    public function index()
    {
        $items = Inventory_Item::with([
            'unit',
            'inventoryStocks.location',
        ])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('inventory.index', compact('items'));
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
