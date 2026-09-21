<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Menu_Items;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(Menu_Items::class);
    }
}
