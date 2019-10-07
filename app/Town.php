<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = ['name', 'name2', 'name3', 'alias'];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }
}
