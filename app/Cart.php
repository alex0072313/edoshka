<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['chat_id', 'dish_id', 'quantity'];
    public $timestamps = false;

    public function dish()
    {
        return $this->hasOne(Dish::class);
    }

}
