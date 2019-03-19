<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Restaurant;
use App\User;

class RestaurantController extends SiteController
{
    public function index(Restaurant $restaurant)
    {
        $this->view = 'site.restaurant';
        $this->data['restaurant'] = $restaurant;

        $categories = Category::HasDishes($restaurant)->get();

        $categories = $categories->map(function ($category)use ($restaurant){
            $category->dishes = $category->dishes->filter(function ($dish) use ($restaurant){
                return $dish->restaurant_id == $restaurant->id ? $dish : false;
            });

            return $category;
        });

        $this->data['categories'] = $categories;

        //$this->data['popular_dishes'] = $restaurant->dishes()->Popular()->get();

        return $this->render();
    }
}
