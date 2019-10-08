<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = ['name', 'name2', 'name3', 'alias', 'meta', 'ya_metric_id', 'g_analitic_id'];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }
}
