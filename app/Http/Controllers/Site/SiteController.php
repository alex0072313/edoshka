<?php

namespace App\Http\Controllers\Site;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Seopage;
use App\Town;
use App\User;

class SiteController extends Controller
{
    protected $admin_categories;
    protected $town;
    protected $cart;

    public function __construct()
    {
        //Текущий город Геленджик
        $this->town = $this->data['_town'] = Town::find(1);

        //Seo теги
        $this->data['seopage'] = [];

        if($seopage = Seopage::where(['url'=>str_replace('/', '-', request()->path()), 'town_id'=>$this->town->id])->first()){
            if($seopage->title) $this->data['seopage']['title'] = $seopage->title;
            if($seopage->description) $this->data['seopage']['description'] = $seopage->description;
            if($seopage->keywords) $this->data['seopage']['keywords'] = $seopage->keywords;
        }

    }

    public function dishes_viewed_save($id)
    {
        $dishes_cookie =
            request()->cookie('dishes_viewed')
            ? explode(',', request()->cookie('dishes_viewed'))
            : [];

        if (!in_array($id, $dishes_cookie)) {
            if(count($dishes_cookie) == 4){
                $dishes_cookie = array_slice($dishes_cookie, 1, 3);
            }
            $dishes_cookie[] = $id;
        }

        $dishes_viewed = [];
        if ($dishes_cookie) {
            $tofind = [];
            foreach ($dishes_cookie as $_id) {
                if ($_id == $id) continue;
                $tofind[] = $_id;
            }
            foreach (Dish::find($tofind) as $dish) {
                $dishes_viewed[] = [
                    'id' => $dish->id,
                    'name' => $dish->name,
                    'short_description' => $dish->short_description,
                    'price' => $dish->price,
                    'new_price' => $dish->new_price,
                    'img' => \Storage::disk('public')->exists('dish_imgs/' . $dish->id . '/img_xs.jpg') ? \Storage::disk('public')->url('dish_imgs/' . $dish->id . '/img_xs.jpg') : null,
                ];
            }
            return response()->json(['dishes_viewed' => array_reverse($dishes_viewed)])->withCookie(cookie('dishes_viewed', implode(',', $dishes_cookie), 3600));
        } else {
            return response()->json(['dishes_viewed' => array_reverse($dishes_viewed)]);
        }

    }

    public function get_dish_for_modal()
    {
        if(!$dish_id = request()->post('dish')) return false;
        if(!$dish = Dish::find($dish_id)) return false;

        $json = [];

        $dishes_cookie =
            request()->cookie('dishes_viewed')
                ? explode(',', request()->cookie('dishes_viewed'))
                : [];

        if (!in_array($dish_id, $dishes_cookie)) {
            if(count($dishes_cookie) == 4){
                $dishes_cookie = array_slice($dishes_cookie, 1, 3);
            }
            $dishes_cookie[] = $dish_id;
        }

        $tofind = [];

        if($dishes_cookie){
            foreach ($dishes_cookie as $_id) {
                if ($_id == $dish_id) continue;
                $tofind[] = $_id;
            }

            $dishes_viewed = Dish::whereIn('id', $tofind)->get()->reverse();
            $json['html'] = view('site.includes.modal_dish', ['dish'=>$dish, 'dishes_viewed'=>$dishes_viewed])->render();
            return response()->json($json)->withCookie(cookie('dishes_viewed', implode(',', $dishes_cookie), 3600));
        }else{
            $json['html'] = view('site.includes.modal_dish', ['dish'=>$dish, 'dishes_viewed'=>[]])->render();
            return response()->json($json);
        }


    }

}
