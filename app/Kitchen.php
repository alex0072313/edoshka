<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    protected $fillable = ['name', 'description'];

    public function dishes()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurants_kitchens');
    }

}
