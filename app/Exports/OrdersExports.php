<?php

namespace App\Exports;

use App\Order;
use Carbon\Carbon;
use App\Restaurant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExports implements FromView
{
    protected $orders;
    protected $restaurant;
    protected $start;
    protected $end;

    public function __construct(array $data = [])
    {
        $this->restaurant = Restaurant::find($data['restaurant_id']);
        $this->start = $data['start'];
        $this->end = $data['end'];
    }

    public function view(): View
    {
        $title = 'Заказы ресторана '.$this->restaurant->name;
        $dates = '';

        if(\Auth::user()->hasRole('megaroot')){
            if($restaurant_id = request('restaurant_id')){
                $this->restaurant = Restaurant::find($restaurant_id);
            }
            $this->data['restaurants'] = Restaurant::all();
        }else{
            $this->restaurant = \Auth::user()->restaurant;
        }

        if($this->restaurant){
            $orders_query = $this->restaurant->orders();
        }else{
            $orders_query = Order::query();
        }

        $orders_query = $orders_query->with('restaurant')->with('user')->with('dishes');

        if($this->start){
            $orders_query = $orders_query->whereDate('created_at', '>', Carbon::createFromDate($this->start)->subDay(1));
            $title .= ' c '.$this->start;
        }
        if($this->end){
            $orders_query = $orders_query->whereDate('created_at', '<', Carbon::createFromDate($this->end)->addDay(1));
            $title .= ' по '.$this->end;
        }

        $orders = $orders_query
            ->where('cancle', '=', 0)
            ->select(['orders.*'])
            ->orderBy('created_at', 'desc')
            ->get();


        if(!$commission = $this->restaurant->commission){
            $commission = 0;
        }

        $orders = $orders->map(function ($order) use ($commission){
            $address = [];
            if($order->home){
                $address[] = $order->home;
            }
            if($order->street){
                $address[] = $order->street;
            }
            $order->address = implode(', ', $address);

            foreach ($order->dishes as $dish){
                $order->total_quantity += $dish->pivot->quantity;
            }

            if($this->restaurant->id == 4){
                if($order->total_price > 999){
                    $commission = 7;
                }else{
                    $commission = 5;
                }
            }

            if($commission > 0){
                $order->commission = ((int)$order->total_price > 0) ? round($order->total_price / 100 * $commission) : 0;
            }

            return $order;
        });

        return view('admin.orders.export', [
            'title' => $title,
            'dates' => $dates,
            'orders' => $orders,
            'total' => $orders->count(),
            'commission' => $this->restaurant->CommissionText,

            'total_price' => $orders->sum(function ($order){
                return $order->TotalPrice;
            }),
            'total_commission' => $orders->sum(function ($order){
                return $order->commission['commission_sum'];
            }),
        ]);
    }
}
