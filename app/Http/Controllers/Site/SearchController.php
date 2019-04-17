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
        if($q = request('q')){
            $json = [];

            $dishes_by_q = Dish::where('name', 'LIKE', '%'.$q.'%')->get();
            $restaurants = collect($this->town->restaurants)
                ->filter(function ($restaurant){

                    if(auth()->check() && auth()->user()->hasRole('megaroot')){
                        return true;
                    }elseif (!$restaurant->active){
                        return false;
                    }

                    return true;
                });

            $dishes = [];
            foreach ($dishes_by_q as $dish){
                $restaurant = $restaurants->firstWhere('id', '=', $dish->restaurant_id);
                $dishes[$dish->restaurant_id][] = [
                    'name' => $dish->name,
                    'price' => $dish->price,
                    'newprice' => $dish->newprice,
                    'href' => route('site.restaurant', ['alias' => $restaurant->alias]).'#dish'.$dish->id
                ];
            }

            foreach ($dishes as $restaurant_id => $dishes){
                $restaurant = $restaurants->firstWhere('id', '=', $restaurant_id);

                $categories = Category::HasDishes($restaurant_id)->get()->map(function ($category){
                    return $category->name;
                })->toArray();

                $json['restaurants'][$restaurant->id] = [
                    'name' => $restaurant->name,
                    'image' => \Storage::disk('public')->exists('restaurant_imgs/'.$restaurant->id.'/thumb_xs.jpg') ? \Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/thumb_xs.jpg') : null,
                    'href' => route('site.restaurant', ['alias' => $restaurant->alias]),
                    'categories' => count($categories) ? implode(' • ', $categories) : null,
                    //'categories' => $categories,
                    'dishes' => $dishes
                ];
            }

            return response()->json($json);
        }else{
            return response()->json([]);
        }

    }
}
