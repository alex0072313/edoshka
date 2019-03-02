<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $fillable = ['name', 'css_class', 'content'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dishes_markers');
    }
}
