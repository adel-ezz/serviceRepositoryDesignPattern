<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = ['name','price'];

    ///=========items Orders that that contains them ======//
    function Orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Orders::class, 'order_items', 'order_id', 'item_id')->withPivot('current_price');
    }
}
