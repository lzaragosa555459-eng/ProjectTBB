<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Option_Groups;

class Menu_Item_Option_Groups extends Model
{
    public function optionGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            Option_Groups::class,
            'menu_item_option_groups'
        )->withPivot('is_required');
    }
}
