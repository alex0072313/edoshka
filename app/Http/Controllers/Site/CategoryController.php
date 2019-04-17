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
            $restaurants = $this->town->restaurants()->ActiveNotMegaRoot()->get()->map(function ($restaurant) use ($dishes){
                $restaurant->all_dishes = $dishes
                ->where('restaurant_id', '=', $restaurant->id)
                ->sortBy('name');

                return $restaurant;
            })->filter(function ($restaurant){
                return $restaurant->all_dishes->count() ? true : false;
            });

            return $restaurants;
        });

        $categories = cache()->rememberForever('town_'.$this->town->id.'_categories_has_dishes', function () use ($restaurants){
            $categories = collect();
            foreach ($restaurants as $restaurant){
                $categories = $categories->merge(Category::HasDishes($restaurant->id)->get());
            }
            return $categories->sortBy('name');
        });

        $this->data['categories'] = $categories;
        $this->data['restaurants'] = $restaurants;

        return $this->render();
    }
}
