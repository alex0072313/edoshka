<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = ['name'];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
