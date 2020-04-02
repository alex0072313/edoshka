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
                case 'getcart':
                    $this->getCart($this->request->get('chat_id'));
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
                'price' => $product->price,
                'weight' => $product->weight,
            ];
        });
    }

    protected function addToCart($chat_id, $prod_id)
    {
        $new_product_id = null;
        $products_res = [];
        $total_cnt = 0;
        $total_price = 0;
        $total_weight = 0;

        if(!Cart::where('chat_id', '=', $chat_id)->where('dish_id', '=', $prod_id)->count()){
            (new Cart(['chat_id' => $chat_id, 'dish_id' => $prod_id]))->save();
            $new_product_id = $prod_id;
        }

        $products = Cart::where('chat_id', '=', $chat_id)->get();

        if($products->count()){
            foreach ($products as $product){
                if($dish = Dish::find($product->dish_id)){
                    $products_res[$dish->id] = [
                        'name' => $dish->name,
                        'price' => $dish->price,
                        'weight' => $dish->weight,
                    ];
                    $total_price += $dish->price;
                    $total_weight += $dish->weight;
                    $total_cnt++;
                }
            }
        }

        $this->response = [
            'chat_id' => $chat_id,
            'products' => $products_res,
            'total_cnt' => $total_cnt,
            'total_price' => $total_price,
            'total_weight' => $total_weight,
        ];

        if($new_product_id) $this->response['new_product_id'] = $new_product_id;
    }

    protected function getCart($chat_id)
    {
        $products_res = [];
        $total_cnt = 0;
        $total_price = 0;
        $total_weight = 0;

        $products = Cart::where('chat_id', '=', $chat_id)->get();

        if($products->count()){
            foreach ($products as $product){
                if($dish = Dish::find($product->dish_id)){
                    $products_res[$dish->id] = [
                        'name' => $dish->name,
                        'price' => $dish->price,
                        'weight' => $dish->weight,
                    ];
                    $total_price += $dish->price;
                    $total_weight += $dish->weight;
                    $total_cnt++;
                }
            }
        }

        $this->response = [
            'chat_id' => $chat_id,
            'products' => $products_res,
            'total_cnt' => $total_cnt,
            'total_price' => $total_price,
            'total_weight' => $total_weight,
        ];
    }


}
