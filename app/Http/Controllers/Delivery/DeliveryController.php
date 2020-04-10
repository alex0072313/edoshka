<?php

namespace App\Http\Controllers\Delivery;

use App\Cart;
use App\Category;
use App\Dish;
use App\Http\Controllers\Controller;
use App\Order;
use App\Restaurant;
use App\User;
use Illuminate\Http\Request;

class DeliveryController extends Controller {

    protected $response = [];
    protected $request = null;
    protected $restaurant = null;
    protected $cart = null;

    public function __construct()
    {
        $this->restaurant = Restaurant::find(28);
    }

    public function index(Request $request)
    {
        if(($token = $request->get('token')) && ($token == getenv('TELEGRAMM_TOKEN'))) {
            if ($type = $request->get('type')) {
                $this->request = $request;
                switch ($type) {
                    case 'categories':
                        $this->getCategories();
                        break;
                    case 'products':
                        $this->getProducts($this->request->get('cat_id'), $this->request->get('offset', 0));
                        break;
                    case 'addtocart':
                        $this->addToCart($this->request->get('chat_id'), $this->request->get('prod_id'));
                        break;
                    case 'getcart':
                        $this->getCart($this->request->get('chat_id'));
                        break;
                    case 'clearcart':
                        $this->clearCart($this->request->get('chat_id'));
                        break;
                    case 'sendorder':
                        $this->sendOrder($this->request->get('chat_id'), $this->request->get('phone'));
                        break;
                }
            } else {
                $this->response = 'Type not exist!';
            }
        }else{
            $this->response = 'Token is reqired!';
        }

        return response()->json($this->response);
    }

    protected function getCategories()
    {
        $dishes = $this->restaurant->dishes;

        $categories =
            Category::all()
                ->map(function ($category) use ($dishes){
                    $dishes_in_cat = $dishes->where('category_id', '=', $category->id);
                    if($dishes_in_cat->count()){
                        $category->dishes = $dishes->where('category_id', '=', $category->id);
                        $category->dishes_cnt = $dishes_in_cat->count();
                    }
                    return $category;
                })->filter(function ($category){
                    return $category->dishes_cnt > 0 ? true : false;
                })->sortBy('name');

        if($this->restaurant->categories_sort){
            $categories = $categories->sortBy(function($category) {
                return array_search($category->id, $this->restaurant->categories_sort);
            });
        }else{
            $categories = $categories->sortBy('name');
        }

        foreach ($categories as $category){
            $this->response[] = [
                'id' => $category->id,
                'name' => $category->name,
                'cnt' => $category->dishes_cnt,
            ];
        }
    }

    protected function getProducts($cat_id, $offset = 0)
    {
        $limit = 9;

        $q = $this->restaurant->dishes()->where('category_id', '=', $cat_id);

        $total = $q->count();

        $products = $q
            ->offset($offset)
            ->limit($limit)
            ->get();

        if(($next_offset = $offset + $limit) < $total){
            $this->response['next_offset'] = $next_offset;
        }

        $this->response['products'] = $products->map(function ($product){
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

        $q_cart_by_chat = Cart::query()->where('chat_id', '=', $chat_id);
        $q_cart_by_dish = $q_cart_by_chat->where('dish_id', '=', $prod_id);

        if(!$q_cart_by_dish->count()){
            (new Cart(['chat_id' => $chat_id, 'dish_id' => $prod_id]))->save();
        }else{
            $now_quantity = $q_cart_by_dish->get()->first()->quantity;
            $q_cart_by_dish->update(['quantity'=>$now_quantity+1]);
        }

        $products = $q_cart_by_chat->get();

        if($products->count()){
            foreach ($products as $product){
                if($dish = Dish::find($product->dish_id)){

                    $weight = $dish->weight * $product->quantity;
                    $price = $dish->price * $product->quantity;

                    $products_res[$dish->id] = [
                        'name' => $dish->name,
                        'price' => $price,
                        'quantity' => $product->quantity,
                        'weight' => $weight,
                    ];

                    $total_price = $total_price + $price;
                    $total_weight = $total_weight + $weight;
                    $total_cnt = $total_cnt + $product->quantity;
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

        $this->response['new_product_id'] = $prod_id;
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
                    $weight = $dish->weight * $product->quantity;
                    $price = $dish->price * $product->quantity;

                    $products_res[$dish->id] = [
                        'name' => $dish->name,
                        'price' => $price,
                        'quantity' => $product->quantity,
                        'weight' => $weight,
                    ];

                    $total_price += $price;
                    $total_weight += $weight;
                    $total_cnt = $total_cnt + $product->quantity;
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

    protected function clearCart($chat_id)
    {
        $products_q = Cart::where('chat_id', '=', $chat_id);

        if($products_q->count()){
            $products_q->delete();
            $this->response['cart_clear'] = true;
        }
    }

    protected function sendOrder($chat_id, $phone)
    {
        $phone = valid_phone($phone);

        $products = Cart::where('chat_id', '=', $chat_id)->get();

        $user_orders = [];

        if($products->count()){
            $order = $this->restaurant->orders()->create(['phone'=> $phone]);
            $sync_data = [];

            $dishes_to_order = Dish::query()->whereIn('id', $products->pluck('dish_id'))->get();

            foreach ($dishes_to_order as $dish) {
                $sync_data[$dish->id] = ['quantity' => 1, 'price' => $dish->price, 'total_price' => $dish->price];
            }

            $order->dishes()->sync($sync_data);

            foreach ($this->restaurant->users as $user) {
                $user->notify(new \App\Notifications\Order($user, $order, $this->restaurant));
            }

            //Дублируем мне
            $admin = User::getAdmin();
            $admin->notify(new \App\Notifications\Order($admin, $order, $this->restaurant));

            $user_orders[] = $order->id;

            $new_email = $phone . '@edoshka.ru';

            if (!$user = User::where('email', '=', $new_email)->orWhere('phone', '=', $phone)->first()) {
                $user = new User();

                $user->email = $new_email;
                $user->phone = $phone;

                $new_password = str_random(6);
                $user->password = \Hash::make($new_password);
                $user->provider = 'phone';
                $user->save();
                $user->assignRole('customer');
            }
        }

        $this->response['success_order'] = true;

        return $this->clearCart($chat_id);
    }


}
