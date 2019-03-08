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

        $this->data['categories'] = Category::HasDishes($restaurant)->get();
        $this->data['popular_dishes'] = $restaurant->dishes()->Popular()->get();

        return $this->render();
    }
}
