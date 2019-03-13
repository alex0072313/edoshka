<?php

namespace App\Http\Controllers\Site;

use App\Dish;
use App\Http\Controllers\Controller;
use App\Order;
use App\Restaurant;

class OrderController extends Controller
{
    public function send()
    {
        $response = [];

        $validate = \Validator::make(request()->all(), [
            'phone' => 'required|min:18'
        ], [
            'phone.required' => 'Необходимо указать телефон!',
            'phone.min' => 'Телефон указан не верно!',
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        $restaurants = [];
        foreach ($dishes = request('dishes') as $dish_id => $quantity){
            $dish = Dish::find($dish_id);
            $restaurants[$dish->restaurant_id][$dish_id] = $quantity;
        }

        foreach ($restaurants as $restaurant_id => $dishes){
            $restaurant = Restaurant::find($restaurant_id);
            $order = $restaurant->orders()->create(request()->all());

            $sync_data = [];
            foreach ($dishes as $dish_id => $quantity){
                $sync_data[$dish_id] = ['quantity'=>$quantity];
            }
            $order->dishes()->sync($sync_data);
        }

        \Cart::clear();

        return response()->json(['success'=>['title'=>'Заказ принят', 'text'=>'Мы перезвоним Вам для уточнения заказа в ближайшее время!']]);
    }
}
