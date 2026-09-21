<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kitchen_Order_Item extends Model
{
    protected $table = 'kitchen_order_items';

    protected $fillable = [
        'order_item_id',
        'prepared_by',
        'status',
        'started_at',
        'completed_at',
    ];

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(
            Order_Item::class,
            'order_item_id'
        );
    }

    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'prepared_by'
        );
    }
}
