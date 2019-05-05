<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Special extends Model
{

    protected $fillable = ['name', 'content', 'status'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurants_specials');
    }
}
