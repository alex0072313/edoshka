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
            $orders = \Auth::user()->restaurant->orders()->sortByDesc('created_ad');
        }

        $orders = $orders->map(function ($order){

            foreach ($order->dishes as $dish){
                $order->total_quantity += $dish->pivot->quantity;
                $order->total_price += $dish->pivot->total_price;
            }

            return $order;
        });

        $this->data['orders'] = $orders;

        return $this->render();
    }
}
