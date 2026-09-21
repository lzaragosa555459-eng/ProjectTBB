<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Menu_Items;
use App\Models\Option_Values;
use App\Models\Inventory_Item;

class Menu_Option_Recipe_Adjustments extends Model
{
    protected $table = 'menu_option_recipe_adjustments';

    protected $fillable = [
        'menu_item_id',
        'option_value_id',
        'inventory_item_id',
        'quantity_adjustment',
    ];
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
