<?php

namespace App\Http\Controllers\Site;

use App\Slide;
use App\User;

class HomeController extends SiteController
{
    public function index()
    {
        $this->view = 'site.home';

        $this->data['slides'] = Slide::all();

        $restaurants = $this->town->restaurants()->active()->get()->map(function ($restaurant){
            $cats = $this->admin_categories
                ->merge(
                    $restaurant->categories
                );
            $dishes = $restaurant->dishes;
            $cats = $cats->filter(function ($cat) use ($dishes){
                $dishes_cats = [];
                foreach ($dishes as $dish){
                    $dishes_cats[$dish->category_id] = $dish->category_id;
                }

                if(isset($dishes_cats[$cat->id])) return $cat;
            });

            $restaurant->cats = $cats;
            return $restaurant;
        });

        $this->data['restaurants'] = $restaurants;

        return $this->render();
    }
}
