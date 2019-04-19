<?php

namespace App\Http\Controllers\Site;

use App\Category;

class CategoryController extends SiteController
{
    public function index(Category $category)
    {
        $this->view = 'site.category';
        $this->data['category'] = $category;

        $restaurants = cache()->rememberForever('category_'.$category->id.'_dishes', function () use ($category){
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

        $categories = cache()->rememberForever('town_'.$this->town->id.'_categories_has_dishes', function () use ($restaurants){
            $categories = collect();
            foreach ($restaurants as $restaurant){
                $categories = $categories->merge(Category::HasDishes($restaurant->id)->get());
            }
            return $categories->sortBy('name');
        })->unique('id');

        $this->data['categories'] = $categories;
        $this->data['restaurants'] = $restaurants;

        return $this->render();
    }
}
