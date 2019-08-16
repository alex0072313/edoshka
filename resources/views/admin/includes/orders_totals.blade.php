<div class="h5 mb-0 mr-3 text-dark">
    Заказы:
    @php
        $t = [];

        if($total_orders){
            $t[] = 'в работе <b id="cnt_total_orders" class="text-green">'.$total_orders.'</b>';
        }

        if($total_cancle){
            $t[] = 'отклонено <b class="text-warning">'.$total_cancle.'</b>';
        }
        if($total_newsum){
            $t[] = 'изм. цены <b class="text-info">'.$total_newsum.'</b>';
        }

        if($t){
            echo implode(', ',$t);
        }
    @endphp
</div>
<div class="h5 mb-0 mr-3 text-dark">Выручка: <b>{{ number_format($total_price) }} ₽</b></div>
<div class="h5 mb-0 mr-3 text-dark">Комиссия: <b>{!! number_format($commission_sum) !!} ₽</b>{!! isset($commission) && $commission ? ' <small class="text-green">(ставка '.$commission.')</small>':'' !!}</div>
