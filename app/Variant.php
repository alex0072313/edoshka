<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public $timestamps = false;

    protected $fillable = ['dish_id', 'name', 'price'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
