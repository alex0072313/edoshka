<?php

namespace App\Http\Controllers\Site;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Town;
use App\User;
use Illuminate\Http\Response;
use Darryldecode\Cart\Cart;

class SiteController extends Controller
{
    protected $admin_categories;
    protected $town;
    protected $cart;

    public function __construct()
    {
        $this->admin_categories = User::getAdmin()->categories()->where('topmenu', '=', true)->get();
        $this->data['top_categories'] = $this->admin_categories;

        //Текущий горо Геленджик
        $this->town = $this->data['_town'] = Town::find(1);
    }

    public function dishes_viewed_save($id)
    {
        $dishes_cookie = request()->cookie('dishes_viewed') ? explode(',',request()->cookie('dishes_viewed')) : [];

        if(!in_array($id, $dishes_cookie)){
            $dishes_cookie[] = $id;
            //if(count($dishes_cookie) > 4){
                //$dishes_cookie = array_slice($dishes_cookie, 10);
            //}
        }

        $dishes_viewed = [];
        if($dishes_cookie){
            $tofind = [];
            foreach ($dishes_cookie as $_id){
                if($_id == $id) continue;
                $tofind[] = $_id;
            }
            foreach (Dish::find($tofind) as $dish){
                $dishes_viewed[] = [
                    'id' => $dish->id,
                    'name' => $dish->name,
                    'short_description' => $dish->short_description,
                    'price' => $dish->price,
                    'new_price' => $dish->new_price,
                    'img' => \Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_xs.jpg') ? \Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_xs.jpg') : null,
                ];
            }
            return response()->json(['dishes_viewed'=>$dishes_viewed])->withCookie(cookie('dishes_viewed', implode(',', $dishes_cookie), 3600));
        }else{
            return response()->json(['dishes_viewed'=>$dishes_viewed]);
        }

    }

}
