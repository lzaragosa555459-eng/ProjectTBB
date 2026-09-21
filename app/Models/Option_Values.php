<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Option_Groups;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Menu_Option_Recipe_Adjustments;
use App\Models\Order_Item_Options;

class Option_Values extends Model
{
    protected $fillable = [
        'option_group_id',
        'name',
        'price_adjustment',
        'is_active',
    ];

    public function optionGroup(): BelongsTo
    {
        return $this->belongsTo(Option_Groups::class);
    }

    public function optionRecipeAdjustments(): HasMany
    {
        return $this->hasMany(Menu_Option_Recipe_Adjustments::class);
    }
    public function orderItemOptions(): HasMany
    {
        return $this->hasMany(Order_Item_Options::class);
    }
}
