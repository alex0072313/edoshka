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
    protected
        $start = 0,
        $step = 100,
        $orders = null,
        $restaurant = null;

    public function index()
    {
        $this->title = 'Заказы';
        $this->view = 'admin.orders.index';

        $orders = $this->getOrders(null, null);

        if($this->restaurant){
            $this->data['restaurant'] = $this->restaurant;
            $this->data['commission'] = $this->restaurant->CommissionText;
        }

        $this->data['total_price'] = $orders->sum(function ($order){
            return $order->TotalPrice;
        });

        $this->data['total_cancle'] = $orders->sum(function ($order){
            return $order->cancle ? 1 : 0;
        });

        $this->data['total_newsum'] = $orders->sum(function ($order){
            return $order->newsum ? 1 : 0;
        });

        $this->data['total_orders'] = $orders->sum(function ($order){
            return $order->cancle ? 0 : 1;
        });

        $this->data['commission_sum'] = $orders->sum(function ($order){
            return $order->commission['commission_sum'];
        });

        $this->data['orders'] = $orders->take($this->step);

        return $this->render();
    }

    public function ordersReport()
    {
        $this->restaurant = Restaurant::find(request('restaurant_id'));

        if(!auth()->user()->hasRole('megaroot|boss') && $this->restaurant && ($this->restaurant->present_id != auth()->id())){
            abort(403);
        }

        $data = [
            'restaurant_id'=>request('restaurant_id'),
            'start'=>request('start'),
            'end'=>request('end'),
        ];

        $name = 'orders-'.$this->restaurant->alias;

        if($data['start']){
            $name .= '-ot-'.$data['start'];
        }

        if($data['end']){
            $name .= '-do-'.$data['end'];
        }

        $name .= '.xlsx';

        return Excel::download(new OrdersExports($data), $name);
    }

    public function getOrders($start = 0, $step = 100)
    {
        if(\Auth::user()->hasRole('megaroot|root')){
            if($restaurant_id = request('restaurant_id')){
                $this->restaurant = Restaurant::find($restaurant_id);
            }
            $this->data['restaurants'] = auth()->user()->hasRole('root') ? auth()->user()->restaurants : Restaurant::all();
        }else{
            $this->restaurant = \Auth::user()->restaurant;
        }

        if(!auth()->user()->hasRole('megaroot|boss') && $this->restaurant && ($this->restaurant->present_id != auth()->id())){
            abort(403);
        }

        if($this->restaurant){
            $orders_query = $this->restaurant->orders();
        }else{
            $orders_query = Order::query();
        }

        $orders_query = $orders_query->with('restaurant')->with('user')->with('dishes');

        if(auth()->user()->hasRole('root')){
            $orders_query = $orders_query
                ->leftJoin('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
                ->where('restaurants.present_id', '=', auth()->id());
        }

        if($start_d = request('start')){
            $orders_query = $orders_query->whereDate('orders.created_at', '>', Carbon::createFromDate($start_d)->subDay(1));
        }

        if($end_d = request('end')){
            $orders_query = $orders_query->whereDate('orders.created_at', '<', Carbon::createFromDate($end_d)->addDay(1));
        }

        $orders_query = $orders_query
            ->select(['orders.*'])
            ->orderBy('orders.created_at', 'desc');

        if($start && $step){
            $orders_query = $orders_query
                ->offset($start)
                ->limit($step);
        }

        return $orders_query->get();
    }

    public function append()
    {
        $orders = $this->getOrders(request('ot'), $this->step);

        $html = '';
        $is_megaroot = auth()->user()->hasRole('megaroot');
        foreach ($orders as $order){
            $html .= view('admin.includes.order_tr_item', ['order' => $order, 'restaurants'=> $this->data['restaurants']])->render();
        }

        return response()->json(['html' => $html, 'request'=>request()->all()]);
    }

    public function getTotals()
    {
        $orders = $this->getOrders(null, null);

        if($this->restaurant){
            $commission = $this->restaurant->CommissionText;
        }

        $total_price = $orders->sum(function ($order){
            return $order->TotalPrice;
        });

        $total_cancle = $orders->sum(function ($order){
            return $order->cancle ? 1 : 0;
        });

        $total_newsum = $orders->sum(function ($order){
            return $order->newsum ? 1 : 0;
        });

        $total_orders = $orders->sum(function ($order){
            return $order->cancle ? 0 : 1;
        });

        $commission_sum = $orders->sum(function ($order){
            return $order->commission['commission_sum'];
        });

        return response()->json([
            'html' => view('admin.includes.orders_totals', [
                'total_price' => $total_price,
                'total_cancle' => $total_cancle,
                'total_newsum' => $total_newsum,
                'total_orders' => $total_orders,
                'commission_sum' => $commission_sum,
                'commission'=>isset($commission) ? $commission : null
            ])->render(),
            'request'=>request()->all()
        ]);
    }

}
