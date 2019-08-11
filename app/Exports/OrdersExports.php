<?php

namespace App\Exports;

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
        $orders = $this->restaurant->orders();

        $title = 'Заказы ресторана '.$this->restaurant->name;
        $dates = '';

        if($this->start){
            $orders = $orders->whereDate('created_at', '>', Carbon::createFromDate($this->start)->subDay(1));
            $title .= ' c '.$this->start;
        }
        if($this->end){
            $orders = $orders->whereDate('created_at', '<', Carbon::createFromDate($this->end)->addDay(1));
            $title .= ' по '.$this->end;
        }

        $orders = $orders->get()->sortByDesc('created_at');

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
                $order->total_price = $order->TotalPrice;
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
            'commission' => $commission,

            'total_price' => $orders->sum(function ($order){
                return $order->total_price;
            }),
            'total_commission' => $orders->sum(function ($order){
                return $order->commission;
            }),
        ]);
    }
}
