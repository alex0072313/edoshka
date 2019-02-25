<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
