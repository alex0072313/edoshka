<?php

namespace App\Http\Controllers\Delivery;

use App\Cart;
use App\Category;
use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller {

    protected $response = [];
    protected $request = null;

    public function index(Request $request)
    {
        if($type = $request->get('type')){

            $this->request = $request;

            switch ($type){
                case 'categories':
                    $this->getCategories();
                break;
                case 'products':
                    $this->getProducts($this->request->get('cat_id'));
                break;
                case 'addtocart':
                    $this->addToCart($this->request->get('chat_id'), $this->request->get('prod_id'));
                break;
            }
        }else{
            $this->response = 'Type not exist!';
        }

        return response()->json($this->response);
    }

    protected function getCategories()
    {
        $categories = Category::all();

        $this->response = $categories->map(function ($category){
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
    }

    protected function getProducts($cat_id)
    {
        $products = Category::find($cat_id)->dishes;

        $this->response = $products->map(function ($product){
            return [
                'id' => $product->id,
                'name' => $product->name,
            ];
        });
    }

    protected function addToCart($chat_id, $prod_id)
    {
        if(!Cart::where('chat_id', '=', $chat_id)->where('dish_id', '=', $prod_id)->count()){

            (new Cart(['chat_id' => $chat_id, 'dish_id'=> $prod_id]))->save();

            $this->response = Cart::where('chat_id', '=', $chat_id)->with('dish')->map(function ($cart_product){
                return [
                    'id' => $cart_product->dish->id,
                    'name' => $cart_product->dish->name,
                ];
            });
        }

    }


}
