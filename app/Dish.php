<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = ['name', 'short_description', 'description', 'price', 'new_price', 'user_id', 'category_id', 'restaurant_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function markers()
    {
        return $this->belongsToMany(Marker::class, 'dishes_markers');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function recomendeds()
    {
        return $this->belongsToMany(Dish::class, 'dishes_recomendeds', 'dish_id', 'recomended_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function scopePopular($query, $marker_css_class = 'top')
    {
        return $query->rightJoin('dishes_markers', 'dishes.id', '=', 'dishes_markers.dish_id')->rightJoin('markers', 'dishes_markers.marker_id', '=', 'markers.id')->select('dishes.*')->where('markers.css_class', '=', $marker_css_class)->groupBy('dishes.id');
    }
}
