<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Inventory_Item;
use App\Models\Inventory_Locations;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Inventory_Transactions;

class Inventory_Stock extends Model
{
    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(Inventory_Item::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Inventory_Locations::class);
    }

    public function inventoryTransactions(): HasMany
    {
        return $this->hasMany(Inventory_Transactions::class);
    }
}
