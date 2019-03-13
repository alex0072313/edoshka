<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'persons', 'street', 'home', 'dop', 'restaurant_id'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dishes_orders', 'order_id', 'dish_id')->withPivot('quantity');
    }

}
