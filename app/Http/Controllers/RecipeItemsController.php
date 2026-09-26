<?php

namespace App\Http\Controllers;

use App\Models\Recipe_Items;
use Illuminate\Http\Request;
use App\Models\Menu_Items;
use App\Models\Inventory_Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RecipeItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuItems = Menu_Items::with([
            'recipeItems.inventoryItem.unit',
        ])
            ->orderBy('name')
            ->get();

        $inventoryItems = Inventory_Item::with('unit')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('recipe-management.index', compact(
            'menuItems',
            'inventoryItems'
        ));
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
        $validated = $request->validate([
            'menu_item_id' => ['required', 'exists:menu_items,id'],
            'ingredients' => ['required', 'array', 'min:1'],
            'ingredients.*.inventory_item_id' => [
                'required',
                'integer',
                Rule::exists('inventory_items', 'id')->where('is_active', true),
            ],
            'ingredients.*.quantity_required' => [
                'required',
                'numeric',
                'gt:0',
            ],
        ]);

        DB::transaction(function () use ($validated) {
            Recipe_Items::where('menu_item_id', $validated['menu_item_id'])
                ->delete();

            foreach ($validated['ingredients'] as $ingredient) {
                Recipe_Items::create([
                    'menu_item_id' => $validated['menu_item_id'],
                    'inventory_item_id' => $ingredient['inventory_item_id'],
                    'quantity_required' => $ingredient['quantity_required'],
                ]);
            }
        });

        return redirect()
            ->route('recipe-management.index')
            ->with('success', 'Recipe saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe_Items $recipe_Items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe_Items $recipe_Items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe_Items $recipe_Items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe_Items $recipe_Items)
    {
        //
    }
}
