<?php

namespace App\Http\Controllers\Site;

use App\Category;

class CategoryController extends SiteController
{
    public function index(Category $category)
    {
        $this->view = 'site.category';
        $this->data['category'] = $category;

        $restaurants = cache()->remember('category_'.$this->town->id.'_'.$category->id.'_dishes', '60', function () use ($category){
            $dishes = $category->dishes;
            $restaurants = $this->town->restaurants
                ->map(function ($restaurant) use ($dishes){
                    $restaurant->all_dishes = $dishes
                    ->where('restaurant_id', '=', $restaurant->id)
                    ->sortBy('name');

                    return $restaurant;
                })->filter(function ($restaurant){
                    return $restaurant->all_dishes->count() ? true : false;
                });

            return $restaurants;
        })->filter(function ($restaurant){
            if($restaurant->active || (auth()->check() && (auth()->user()->hasRole('megaroot') || auth()->user()->hasRole('boss')))) return true;
            return false;
        });

        if(!$restaurants->count()) return abort(404);

        //$categories = cache()->rememberForever('town_'.$this->town->id.'_categories_has_dishes', function () use ($restaurants){
            $categories = collect();
            foreach ($restaurants as $restaurant){
                $categories = $categories->merge(Category::HasDishes($restaurant->id)->get());
            }
            //return $categories->sortBy('name');
        //})->unique('id');

        $this->data['categories'] = $categories->sortBy('name')->unique('id');
        $this->data['restaurants'] = $restaurants->shuffle();

        return $this->render();
    }
}
