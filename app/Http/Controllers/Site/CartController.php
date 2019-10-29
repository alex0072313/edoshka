<?php

namespace App\Http\Controllers\Site;

use App\Dish;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class CartController extends SiteController
{
    protected $dish = null, $restaurant;

    public function init()
    {
        if($action = request('action')){
            if($dish_id = request('dish_id')){
                $this->dish = Dish::find($dish_id);
                $this->restaurant = $this->dish->restaurant;
            }
            if(method_exists($this, $action)){
                return $this->$action();
            }
        }

        return response()->json(['error' => 'Метод отсутствует!']);
    }

    protected function add()
    {
        if($worktime = $this->restaurant->worktime){
            if((strtotime(date('H:i')) < strtotime($worktime[0])) || (strtotime(date('H:i')) > strtotime($worktime[1]))){
                //не попадает во время работы
                return response()->json(['worktime_invalid' => [
                    'name' => $this->restaurant->name,
                    'worktime_ot' => $worktime[0],
                    'worktime_do' => $worktime[1],
                ]]);
            }
        }

        if($this->dish->variants->count() && !request('variants')){
            //нужно выбрать вариант
            return response()->json(['variants_invalid' => true]);
        }

        if(\Cart::getTotal()){
            foreach (\Cart::getContent() as $dish){
                if($dish->attributes['restaurant']->id != $this->restaurant->id){
                    //заказ только в 1 ресторане за раз
                    return response()->json(['rest_exist' => [
                        'name' => $dish->attributes['restaurant']->name
                    ]]);
                }
            }
        }

        $image = \Storage::disk('public')->exists('dish_imgs/'.$this->dish->id.'/img_xs.jpg') ? \Storage::disk('public')->url('dish_imgs/'.$this->dish->id.'/img_xs.jpg') : null;

        $price = $this->dish->new_price ? $this->dish->new_price : $this->dish->price;
        if(request('price')){
            $price = request('price');
        }
        $product = array(
            'id' => $this->dish->id,
            'name' => $this->dish->name,
            'price' => $price,
            'quantity' => 1,
            'attributes' => array_merge($this->dish->toArray(), [
                'weight' => request('weight') ? request('weight') : $this->dish->weight,
                'variants' => request('variants'),
                'image' => $image,
                'restaurant'=>$this->restaurant
            ]),
        );

        \Cart::add($product);

        $restaurants_small_order = $this->check_small_order();

        return response()->json([
            'total' => \Cart::getTotalQuantity(),
            'sum'=>\Cart::getTotal(),
            'small_order'=>$restaurants_small_order,
            'content'=>view('site.includes.card_content',
                    [
                        '_cart_content' => \Cart::getContent(),
                        '_cart_restaurants_small_order' => $restaurants_small_order,
                    ]
                )->render() ]);
    }

    protected function get()
    {

    }

    protected function remove()
    {
        \Cart::remove($this->dish->id);

        $restaurants_small_order = $this->check_small_order();

        return response()->json([
            'total' => \Cart::getTotalQuantity(),
            'sum'=>\Cart::getTotal(),
            'small_order'=>$restaurants_small_order,
            'content'=>view('site.includes.card_content',
                    [
                        '_cart_content' => \Cart::getContent(),
                        '_cart_restaurants_small_order' => $restaurants_small_order
                    ]
                )->render()]);
    }

    protected function quantity()
    {
        if(request('remove') == '0'){
            \Cart::update($this->dish->id, [
                'quantity'=>request('quantity')
            ]);
        }else{
            \Cart::remove($this->dish->id);
        }

        $restaurants_small_order = $this->check_small_order();

        return response()->json([
            'quantity'=>request('quantity'),
            'remove'=>request('remove'),
            'total' => \Cart::getTotalQuantity(),
            'sum'=>\Cart::getTotal(),
            'small_order'=>$restaurants_small_order,
            'content'=>view('site.includes.card_content',
                [
                    '_cart_content' => \Cart::getContent(),
                    '_cart_restaurants_small_order' => $restaurants_small_order
                ]
            )->render()
        ]);
    }

    protected function check_small_order()
    {
        $restaurants_sums = [];
        $restaurants_small_order = null;
        $restaurants_min_sum_order = [];

        $content = \Cart::getContent();

        foreach ($content as $dish){
            if(isset($dish->attributes['restaurant'])){
                $restaurants_sums[$dish->attributes['restaurant']->id][] = $dish->price * $dish->quantity;
                $restaurants_min_sum_order[$dish->attributes['restaurant']->id] = $dish->attributes['restaurant']->min_sum_order;
            }
        }

        foreach ($restaurants_sums as $id => $restaurants_sum){
            $sum = array_sum($restaurants_sum);
            if($sum < $restaurants_min_sum_order[$id]){
                $restaurants_small_order = $restaurants_min_sum_order[$id];
                break;
            }
        }

        return $restaurants_small_order;
    }

    protected function clear()
    {
        \Cart::clear();
        $restaurants_small_order = $this->check_small_order();
        return response()->json([
            'total' => \Cart::getTotalQuantity(),
            'sum'=>\Cart::getTotal(),
            'small_order'=>$restaurants_small_order,
            'content'=>view('site.includes.card_content',
                [
                    '_cart_content' => \Cart::getContent(),
                    '_cart_restaurants_small_order' => $restaurants_small_order
                ]
            )->render()]);
    }


}
