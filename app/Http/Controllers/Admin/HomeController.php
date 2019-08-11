<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Restaurant;
use Carbon\Carbon;

use App\Exports\OrdersExports;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class HomeController extends AdminController
{
    public function index()
    {
        $restaurant = null;

        if($restaurant_id = request('restaurant_id')){
            $restaurant = Restaurant::find($restaurant_id);
        }

        $this->title = 'Заказы';
        $this->view = 'admin.orders.index';

        if(\Auth::user()->hasRole('megaroot')){
            if($restaurant){
                $orders = $restaurant->orders();
                $this->data['restaurant'] = $restaurant;
            }else{
                $orders = Order::query();
            }
        }else{
            $this->data['restaurant'] = \Auth::user()->restaurant;
            $orders = $this->data['restaurant']->orders();
        }

        if($start = request('start')){
            $orders = $orders->whereDate('created_at', '>', Carbon::createFromDate($start)->subDay(1));
        }

        if($end = request('end')){
            $orders = $orders->whereDate('created_at', '<', Carbon::createFromDate($end)->addDay(1));
        }

        $orders = $orders->get()->sortByDesc('created_ad');

        $orders = $orders->map(function ($order){
            $order->total_price = $order->TotalPrice;
            foreach ($order->dishes as $dish){
                $order->total_quantity += $dish->pivot->quantity;
            }

            return $order;
        });

        $this->data['orders'] = $orders;

        $this->data['total_price'] = $total_price = $orders->sum(function ($order){
            return $order->total_price;
        });

        $this->data['commission_calc'] = 0;

        if($restaurant){
            $this->data['commission_calc'] = round($total_price / 100 * $restaurant->commission);
        }else{
            $restaurants =
                $orders
                ->pluck('restaurant_id')
                ->unique();

            $restaurant_commission = [];
            foreach ($restaurants as $restaurant){
                if($commission = Restaurant::find($restaurant)->commission){
                    $restaurant_commission[$restaurant] = $commission;
                }
            }

            $commission_calc = 0;
            foreach ($orders as $order){
                if(isset($restaurant_commission[$order->restaurant_id])){
                    $total_price = 0;
                    foreach ($order->dishes as $dish){
                        $total_price += $dish->pivot->total_price;
                    }

                    if((int)$total_price && (int)$restaurant_commission[$order->restaurant_id]) $commission_calc += round($total_price / 100 * $restaurant_commission[$order->restaurant_id]);
                }

            }

            $this->data['commission_calc'] = $commission_calc;
        }

        return $this->render();
    }

    public function ordersReport()
    {
        $data = [
            'restaurant_id'=>request('restaurant_id'),
            'start'=>request('start'),
            'end'=>request('end'),
        ];

        $name = 'orders';

        if($data['start']){
            $name .= '-ot-'.$data['start'];
        }

        if($data['end']){
            $name .= '-do-'.$data['end'];
        }

        $name .= '.xlsx';

        return Excel::download(new OrdersExports($data), $name);
    }

}
