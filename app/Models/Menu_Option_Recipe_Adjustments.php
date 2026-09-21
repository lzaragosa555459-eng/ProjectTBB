<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Menu_Items;
use App\Models\Option_Values;
use App\Models\Inventory_Item;

class Menu_Option_Recipe_Adjustments extends Model
{
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(Menu_Items::class);
    }

    public function optionValue(): BelongsTo
    {
        return $this->belongsTo(Option_Values::class);
    }
    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(Inventory_Item::class);
    }
}
