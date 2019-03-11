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
        $image = \Storage::disk('public')->exists('dish_imgs/'.$this->dish->id.'/img_xs.jpg') ? \Storage::disk('public')->url('dish_imgs/'.$this->dish->id.'/img_xs.jpg') : null;

        $product = array(
            'id' => $this->dish->id,
            'name' => $this->dish->name,
            'price' => $this->dish->new_price ? $this->dish->new_price : $this->dish->price,
            'quantity' => 1,
            'attributes' => array_merge($this->dish->toArray(), ['image' => $image]),
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
