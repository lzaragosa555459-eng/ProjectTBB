<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Order_Item;
use App\Models\Option_Values;

class Order_Item_Options extends Model
{
    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(Order_Item::class);
    }
    public function optionValue(): BelongsTo
    {
        return $this->belongsTo(Option_Values::class);
    }
}
