<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\District;
use App\Restaurant;
use App\Slide;
class HomeController extends SiteController
{
    public function index()
    {
        $this->view = 'site.home';

        $this->data['slides'] = $this->town->slides;

        $restaurants = $this->town
            ->restaurants()
            ->with('kitchens')
            ->get()
            ->filter(function ($restaurant){
                if($restaurant->active || (auth()->check() && auth()->user()->hasRole('megaroot|boss|root')) ) return true;
                return false;
            })
            ->map(function ($restaurant){
                $restaurant->kitchens = $restaurant->kitchens->pluck('name')->toArray();

                return $restaurant;
            });


        if($this->town->restaurants_sort){
            $restaurants = $restaurants->sortBy(function($restaurant){
                return array_search($restaurant->id, $this->town->restaurants_sort);
            });
        }else{
            $restaurants = $restaurants->sortBy('id');
        }

        $this->data['districts'] = $this->town->districts;
        $restaurants_with_districts = [];
        $restaurants_without_districts = [];

        foreach ($restaurants as $restaurant){
            if($restaurant->district_id){
                $restaurants_with_districts[$restaurant->district_id][] = $restaurant;
            }else{
                $restaurants_without_districts[] = $restaurant;
            }
        }

        $this->data['restaurants_with_districts'] = $restaurants_with_districts;
        $this->data['restaurants_without_districts'] = $restaurants_without_districts;

        return $this->render();
    }
}
