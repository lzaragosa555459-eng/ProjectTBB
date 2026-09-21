<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Menu_Items;
use App\Models\Inventory_Item;

class Recipe_Items extends Model
{
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(Menu_Items::class);
    }
    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(Inventory_Item::class);
    }
}
