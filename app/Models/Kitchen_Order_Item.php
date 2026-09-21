<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Order_Item;
use App\Models\User;

class Kitchen_Order_Item extends Model
{
    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(Order_Item::class);
    }
    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }
}
