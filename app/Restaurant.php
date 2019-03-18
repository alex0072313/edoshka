<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name', 'address', 'description', 'min_sum_order', 'town_id', 'alias'
    ];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function managers(){
        $filtered = $this->users->filter(function ($user) {
            return $user->hasRole(config('role.names.manager.name'));
        });

        return $filtered->all();
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class, User::class,
            'restaurant_id', 'user_id', 'id'
        );
    }

    public function boss(){
        $filtered = $this->users->filter(function ($user) {
            return $user->hasRole(config('role.names.boss.name'));
        });

        return $filtered[0];
    }

    public function categoryGroup(){
        $dishes = [];
        foreach (Dish::all() as $dish){
            $dishes[$dish->category->name][] = $dish;
        }

        return $dishes;
    }

    public function scopeDishsByCat($query)
    {
        $dishes = [];
        foreach ($this->hasMany(Dish::class)->get() as $dish){
            $dishes[$dish->category->name][] = $dish;
        }

        return $dishes;
    }

    public function delete()
    {
        $this->users()->delete();
        Storage::disk('public')->deleteDirectory('restaurant_imgs/'.$this->id);
        return parent::delete();
    }

}
