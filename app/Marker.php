<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $fillable = ['name', 'bg', 'border', 'color', 'content'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dishes_markers');
    }
}
