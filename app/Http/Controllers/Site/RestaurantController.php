<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Restaurant;
use App\User;
use vakata\database\Query;

class RestaurantController extends SiteController
{
    public function index(Restaurant $restaurant)
    {
        $red = false;
        if(!$restaurant->active){
            $red = true;
            if(auth()->check() && auth()->user()->hasRole('megaroot|boss|root')){
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

        $restaurant_dishes = cache()->rememberForever('restaurant_'.$restaurant->id.'_categories_dishes', function () use ($restaurant){
            $dishes = $restaurant->dishes;

            $orders_ids = $restaurant->orders->map(function ($order){
                return $order->id;
            })->toArray();
            $dishes_orders = \DB::table('dishes_orders')->select(['dish_id'])->whereIn('order_id', $orders_ids)->groupBy(['dish_id'])->get();

            $dishes_pop = $dishes
            ->filter(function ($dish) use ($dishes_orders){
                return $dishes_orders->where('dish_id', '=', $dish->id)->count() ? true : false;
            })
            ->sortBy(function($dish) use ($dishes_orders){
                return $dishes_orders->where('dish_id', '=', $dish->id)->count();
            })->take(8);

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

            return ['categories' => $categories->sortBy('name'), 'pop' => $dishes_pop];
        });

        if($restaurant->categories_sort){
            $restaurant_dishes['categories'] = $restaurant_dishes['categories']->sortBy(function($category) use ($restaurant){
                return array_search($category->id, $restaurant->categories_sort);
            });
        }else{
            $restaurant_dishes['categories'] = $restaurant_dishes['categories']->sortBy('name');
        }

        $this->data['categories'] = $restaurant_dishes['categories'];
        $this->data['dishes_pop'] = $restaurant_dishes['pop'];

        $this->data['specials'] = $restaurant->specials;

        return $this->render();
    }
}
