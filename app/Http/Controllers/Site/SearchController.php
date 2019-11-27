<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Dish;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends SiteController
{
    public function query()
    {
        $json = [];

        if($q = request('q')){

            $restaurants =  $this->town
                ->restaurants()
                ->active()
                ->get()
                ->map(function ($r){

                    $c = Category::HasDishes($r->id)->get()->map(function ($category){
                        return $category->name;
                    })->toArray();

                    $r->categories_str = count($c) ? implode(' • ', $c) : null;

                    return $r;
                });

            $dishes = $this->town->dishes()
                ->leftJoin('categories', 'dishes.category_id','=','categories.id')
                ->whereRaw("(dishes.name LIKE '%".$q."%' OR dishes.description LIKE '%".$q."%' OR categories.name LIKE '%".$q."%')")
                ->whereIn('dishes.restaurant_id', $restaurants->pluck('id')->toArray())
                ->select(['dishes.*'])
                ->limit(20)
                ->get();


            foreach ($restaurants as $restaurant){
                $restaurant_dishes = $dishes->where('restaurant_id', '=', $restaurant->id);

                if(!$restaurant_dishes->count()) continue;

                $c = Category::HasDishes($restaurant->id)->get()->map(function ($category){
                    return $category->name;
                })->unique()->toArray();

                $d = [];
                foreach ($restaurant_dishes as $dish){
                    $d[] = [
                        'name' => $dish->name,
                        'image' => \Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_xxs.jpg') ? \Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_xxs.jpg') : null,
                        'price' => $dish->price,
                        'newprice' => $dish->newprice,
                        'href' => route('site.restaurant', ['alias' => $restaurant->alias]).'#d='.$dish->id
                    ];
                }

                $json['restaurants'][$restaurant->id] = [
                    'name' => $restaurant->name,
                    'image' => \Storage::disk('public')->exists('restaurant_imgs/'.$restaurant->id.'/thumb_xs.jpg') ? \Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/thumb_xs.jpg') : null,
                    'href' => route('site.restaurant', ['alias' => $restaurant->alias]),
                    'categories' => count($c) ? implode(' • ', $c) : null,
                    'dishes' => $d
                ];

            }

        }

        return response()->json($json);

    }
}
