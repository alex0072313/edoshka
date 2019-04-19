<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Slide;
use App\User;

class HomeController extends SiteController
{
    public function index()
    {
        $this->view = 'site.home';

        $this->data['slides'] = Slide::all();

        $restaurants = $this->town->restaurants
            ->filter(function ($restaurant){
                if($restaurant->active || (auth()->check() && (auth()->user()->hasRole('megaroot') || auth()->user()->hasRole('boss')))) return true;
                return false;
            })
            ->map(function ($restaurant){
//            $cats = $this->admin_categories
//                ->merge(
//                    $restaurant->categories
//                );

            $cats = Category::all();

            $dishes = $restaurant->dishes;
            $restaurant->cats = $cats->filter(function ($cat) use ($dishes){
                $dishes_cats = [];
                foreach ($dishes as $dish){
                    $dishes_cats[$dish->category_id] = $dish->category_id;
                }

                if(!isset($dishes_cats[$cat->id])) return false;
                return true;

            });

            return $restaurant;
        });

        $this->data['restaurants'] = $restaurants;

        return $this->render();
    }
}
