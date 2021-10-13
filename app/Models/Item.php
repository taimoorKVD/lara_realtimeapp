<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    /**
     * Get the user that owns the phone.
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
