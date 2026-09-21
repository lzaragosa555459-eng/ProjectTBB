<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Inventory_Stock;
use App\Models\Recipe_Items;
use App\Models\Menu_Option_Recipe_Adjustments;

class Inventory_Item extends Model
{
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function inventoryStocks(): HasMany
    {
        return $this->hasMany(Inventory_Stock::class);
    }

    public function recipeItems(): HasMany
    {
        return $this->hasMany(Recipe_Items::class);
    }

    public function optionRecipeAdjustments(): HasMany
    {
        return $this->hasMany(Menu_Option_Recipe_Adjustments::class);
    }
}
