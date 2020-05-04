<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = ['name', 'name2', 'name3', 'alias', 'meta', 'ya_metric_id', 'g_analitic_id', 'restaurants_sort'];

    protected $casts = [
        'restaurants_sort' => 'array'
    ];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }

    public function dishes()
    {
        return $this->hasManyThrough(
            Dish::class,
            Restaurant::class,
            'town_id',
            'restaurant_id',
            'id'
        );
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
