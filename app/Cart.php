<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['chat_id', 'dish_id'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

}
