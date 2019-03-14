<?php

namespace App\Http\Controllers\Admin;

use App\Order;

class HomeController extends AdminController
{
    public function index()
    {
        $this->title = 'Заказы';
        $this->view = 'admin.orders.index';

        if(\Auth::user()->hasRole('megaroot')){
            $orders = Order::all()->sortByDesc('created_ad');
        }else{
            $orders = Order::all()->sortByDesc('created_ad');
        }

        $orders = $orders->map(function ($order){

            foreach ($order->dishes as $dish){
                $order->quantity += $dish->pivot->quantity;
                $order->price += $dish->price;
            }

            return $order;
        });

        $this->data['orders'] = $orders;

        return $this->render();
    }
}
