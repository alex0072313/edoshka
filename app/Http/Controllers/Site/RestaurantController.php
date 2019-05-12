<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Restaurant;
use App\User;

class RestaurantController extends SiteController
{
    public function index(Restaurant $restaurant)
    {
        $red = false;
        if(!$restaurant->active){
            $red = true;
            if(auth()->check() && (auth()->user()->hasRole('megaroot') || auth()->user()->hasRole('boss'))){
                $red = false;
            }
        }

        if($red) return redirect()->route('site.home');

        $this->view = 'site.restaurant';
        $this->data['restaurant'] = $restaurant;

//        $categories = Category::HasDishes($restaurant)->get();
//
//        $categories = $categories->map(function ($category)use ($restaurant){
//            $category->dishes = $category->dishes->filter(function ($dish) use ($restaurant){
//                return $dish->restaurant_id == $restaurant->id ? $dish : false;
//            });
//
//            return $category;
//        });
//
//        $this->data['categories'] = $categories;

        $categories = cache()->rememberForever('restaurant_'.$restaurant->id.'_categories_dishes', function () use ($restaurant){
            $dishes = $restaurant->dishes;
            $categories =
                Category::all()
                    ->map(function ($category) use ($dishes){
                        $dishes_in_cat = $dishes->where('category_id', '=', $category->id);
                        if($dishes_in_cat->count()){
                            $category->dishes = $dishes->where('category_id', '=', $category->id)->map(function ($dish){
                                $dish->all_markers = $dish->markers;
                                return $dish;
                            });
                            $category->dishes_cnt = $dishes_in_cat->count();
                        }
                        return $category;
                    })->filter(function ($category){
                        return $category->dishes_cnt > 0 ? true : false;
                    });

            return $categories->sortBy('name');
        });

        if($restaurant->categories_sort){
            $categories = $categories->sortBy(function($category) use ($restaurant){
                return array_search($category->id, $restaurant->categories_sort);
            });
        }else{
            $categories = $categories->sortBy('name');
        }

        $this->data['categories'] = $categories;
        $this->data['specials'] = $restaurant->specials;

        return $this->render();
    }
}
