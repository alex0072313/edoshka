<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'persons', 'street', 'home', 'dop', 'restaurant_id', 'user_id', 'user_telegramm_log_id'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::deleting(function($order) {
            \DB::table('dishes_orders')->where('order_id', '=', $order->id)->delete();
        });
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dishes_orders', 'order_id', 'dish_id')->withPivot(['quantity', 'price', 'total_price', 'variants']);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalPriceAttribute()
    {
        if($this->cancle) return 0;

        return $this->newsum > 0 ? $this->newsum : $this->OldTotalPrice;
    }

    public function getOldTotalPriceAttribute()
    {
        $total = 0;
        if($this->dishes->count()){
            foreach ($this->dishes as $dish){
                $total += $dish->pivot->total_price;
            }
        }

        return $total;
    }

    public function getCommissionAttribute()
    {
        $commission_sum = 0;
        $order_total_sum = $this->TotalPrice;

        if($commission = $this->restaurant->commission){

            $percent = 0;

            if(is_numeric($commission)){
                //обычное число
                $percent = (int)$commission;
            }else{
                //вилка
                $fork = explode('|', $commission);

                foreach ($fork as $fork_part){
                    $fork_item = explode(':', $fork_part);
                    $diaposon = explode(',', $fork_item[0]);
                    $percent = (int)$fork_item[1];

                    if(count($diaposon) > 1){
                        //от-до
                        if(($order_total_sum >= $diaposon[0]) && ($order_total_sum <= $diaposon[1])){
                            break;
                        }
                    }else{
                        //от
                        if($order_total_sum >= $diaposon[0]){
                            break;
                        }
                    }
                }
            }
            if($percent){
                $commission_sum = round($order_total_sum / 100 * $percent);
            }
        }

        return collect(['commission_sum'=>$commission_sum, 'commission_percent'=>$percent]);
    }


}
