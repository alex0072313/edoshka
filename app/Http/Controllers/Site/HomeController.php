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

        $restaurants = $this->town
            ->restaurants()
            ->with('kitchens')
            ->get()
            ->filter(function ($restaurant){
                if($restaurant->active || (auth()->check() && (auth()->user()->hasRole('megaroot') || auth()->user()->hasRole('boss')))) return true;
                return false;
            })
            ->map(function ($restaurant){
                $restaurant->kitchens = $restaurant->kitchens->pluck('name')->toArray();

                return $restaurant;
            });

        $this->data['restaurants'] = $restaurants;

        return $this->render();
    }
}
