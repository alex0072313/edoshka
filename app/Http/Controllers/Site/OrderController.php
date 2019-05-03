<?php

namespace App\Http\Controllers\Site;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Notifications\NewOrder;
use App\Order;
use App\Restaurant;
use App\User;

class OrderController extends Controller
{
    public function send()
    {
        $response = [];

        $validate = \Validator::make(request()->all(), [
            'phone' => 'required'
        ], [
            'phone.required' => 'Необходимо указать телефон!',
            'phone.min' => 'Телефон указан не верно!',
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        $restaurants = [];
        $prices = [];
        foreach ($dishes = request('dishes') as $dish_id => $quantity){
            $dish = Dish::find($dish_id);
            $prices[$dish_id] = $dish->new_price ? $dish->new_price : $dish->price;
            $restaurants[$dish->restaurant_id][$dish_id] = $quantity;
        }

        foreach ($restaurants as $restaurant_id => $dishes){
            $restaurant = Restaurant::find($restaurant_id);

            //Привязываем к юзеру
            if(auth()->user()){
                request()->request->add(['user_id'=>auth()->id()]);
            }

            $order = $restaurant->orders()->create(request()->all());

            $sync_data = [];
            $dishes_variants = request('dishes_variants');
            foreach ($dishes as $dish_id => $quantity){
                $variants = isset($dishes_variants[$dish_id]) ? $dishes_variants[$dish_id] : '';

                $sync_data[$dish_id] = ['quantity'=>$quantity, 'price'=>$prices[$dish_id], 'variants'=>$variants, 'total_price'=>$prices[$dish_id] * $quantity];
            }
            $order->dishes()->sync($sync_data);

            foreach ($restaurant->users as $user){
                //$user->notify(new NewOrder($user, $order));
                $user->notify(new \App\Notifications\Order($user, $order));
            }

            //Дублируем мне
            $admin = User::getAdmin();
            $admin->notify(new \App\Notifications\Order($admin, $order));
        }

        \Cart::clear();

        return response()->json(['success'=>['title'=>'Заказ принят', 'text'=>'Мы перезвоним Вам для уточнения заказа в ближайшее время!']]);
    }
}
