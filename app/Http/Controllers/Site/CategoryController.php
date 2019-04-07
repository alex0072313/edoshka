<?php

namespace App\Http\Controllers\Site;

use App\Category;

class CategoryController extends SiteController
{
    public function index(Category $category)
    {
        $this->view = 'site.category';
        $this->data['category'] = $category;

        $restaurants = cache()->remember('category_'.$category->id.'_dishes', 30, function () use ($category){
            $dishes = $category->dishes;
            $restaurants = $this->town->restaurants->map(function ($restaurant) use ($dishes){
                $restaurant->all_dishes = $dishes->where('restaurant_id', '=', $restaurant->id);
                return $restaurant;
            })->filter(function ($restaurant){
                return $restaurant->all_dishes->count() ? true : false;
            });

            return $restaurants;
        });

        $categories = cache()->remember('town_'.$this->town->id.'_categories_has_dishes', 30, function () use ($restaurants){
            $categories = collect();
            foreach ($restaurants as $restaurant){
                $categories = $categories->merge(Category::HasDishes($restaurant->id)->get());
            }
            return $categories;
        });

        $this->data['categories'] = $categories;
        $this->data['restaurants'] = $restaurants;

        return $this->render();
    }
}
