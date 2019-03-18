<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'icon', 'alias', 'topmenu'];

//    public function getRouteKeyName()
//    {
//
//        return 'alias';
//    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function parent()
    {
        return Category::where('id', $this->parent_id)->first();
    }

    public function childs() {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function isDefault(){
        return $this->user->hasRole('megaroot');
    }

    public static function allToAccess(){
        $results = [];

        if (auth()->user()->hasRole('megaroot')){
            $results = Category::all();
        }else{
            $results = User::getAdmin()
                ->categories()
                ->get()
                ->merge(
                    auth()->user()->restaurant->categories
                );
        }

        return $results;
    }

    public function restaurant()
    {
        return $this->user->restaurant;
    }

    public function delete()
    {
        \Storage::disk('public')->deleteDirectory('category_imgs/'.$this->id);
        return parent::delete();
    }

    public function scopeHasDishes($query, $restaurant)
    {
        return $query->rightJoin('dishes', 'categories.id', '=', 'dishes.category_id')->select('categories.*')->where('dishes.restaurant_id', '=', isset($restaurant->id) ? $restaurant->id : $restaurant)->groupBy('id');
    }

}
