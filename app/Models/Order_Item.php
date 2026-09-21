<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Order;
use App\Models\Menu_Items;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Order_Item_Options;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Kitchen_Order_Item;

class Order_Item extends Model
{
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(Menu_Items::class);
    }
    public function orderItemOptions(): HasMany
    {
        return $this->hasMany(Order_Item_Options::class);
    }
    public function kitchenOrderItem(): HasOne
    {
        return $this->hasOne(Kitchen_Order_Item::class);
    }
}
