<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    /**
     * Get the phone record associated with the user.
     */
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
