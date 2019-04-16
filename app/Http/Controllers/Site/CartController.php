<?php

namespace App\Http\Controllers\Site;

use App\Dish;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class CartController extends SiteController
{
    protected $dish = null;

    public function init()
    {
        if($action = request('action')){
            if($dish_id = request('dish_id')){
                $this->dish = Dish::find($dish_id);
            }
            if(method_exists($this, $action)){
                return $this->$action();
            }
        }

        return response()->json(['error' => 'Метод отсутствует!']);
    }

    protected function add()
    {
        if($worktime = $this->dish->restaurant->worktime){
            if((strtotime(date('H:i')) < strtotime($worktime[0])) || (strtotime(date('H:i')) > strtotime($worktime[1]))){
                //не попадает во время работы
                return response()->json(['worktime_invalid' => [
                    'name' => $this->dish->restaurant->name,
                    'worktime_ot' => $worktime[0],
                    'worktime_do' => $worktime[1],
                ]]);
            }
        }

        if($this->dish->variants->count() && !request('variants')){
            //нужно выбрать вариант
            return response()->json(['variants_invalid' => true]);
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
                'restaurant'=>$this->dish->restaurant
            ]),
        );

        \Cart::add($product);

        return response()->json(['total' => \Cart::getTotalQuantity(), 'sum'=>\Cart::getTotal(), 'content'=>\Cart::getContent()]);
    }

    protected function get()
    {

    }

    protected function remove()
    {
        \Cart::remove($this->dish->id);
        return response()->json(['total' => \Cart::getTotalQuantity(), 'sum'=>\Cart::getTotal(), 'content'=>\Cart::getContent()]);
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

        return response()->json(['quantity'=>request('quantity'), 'remove'=>request('remove'), 'total' => \Cart::getTotalQuantity(), 'sum'=>\Cart::getTotal(), 'content'=>\Cart::getContent()]);
    }

    protected function all()
    {

    }
}
