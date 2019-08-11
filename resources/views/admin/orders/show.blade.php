<div class="modal-header">
    <h5 class="modal-title">Детали заказа #{{ $order->id }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" data-title="Детали заказа #{{ $order->id }}">

    @if($order->newsum)
        <div class="alert alert-info" role="alert">
            <h4 class="mb-0">Сумма заказа была изменена на {{ $order->newsum }} ₽</h4>
            @if($order->newsum_comment)
                <div class="mt-2">
                    <b>Причина:</b><br>{{ $order->newsum_comment }}
                </div>
            @endif
        </div>
    @endif

    @if($order->cancle)
        <div class="alert alert-warning" role="alert">
            <h4 class="mb-0">Заказ был отменен</h4>
            @if($order->cancle_comment)
                <div class="mt-2">
                    <b>Причина:</b><br>{{ $order->cancle_comment }}
                </div>
            @endif
        </div>
    @endif

    <style>
        @media print {

            table {
                font-size: 14px !important;
            }

        }
    </style>

    <h4>Информация о заказе:</h4>
    <table class="table table-bordered table-sm">
        <tr>
            <td>
                <b>ID заказа:</b> {{ $order->id }}<br>
                <b>Создан:</b> {{ $order->created_at }}<br>
                <b>Оплата:</b> при получении
            </td>
            <td>
                @if($order->name)
                    <b>Имя:</b> {{ $order->name }}<br>
                @endif
                @if($order->phone)
                    <b>Телефон:</b> {{ $order->phone }}<br>
                @endif
                @if($order->email)
                    <b>Email:</b> {{ $order->email }}<br>
                @endif

                @php
                    $address = [];
                    if($order->home){
                        $address[] = $order->home;
                    }
                    if($order->street){
                        $address[] = $order->street;
                    }

                    $address = implode(', ', $address);
                @endphp
                @if($address)
                    <b>Адрес:</b> {{ $address }}<br>
                @endif
                @if($order->persons)
                    <b>Кол-во персон:</b> {{ $order->persons }}<br>
                @endif
                @if($order->dop)
                    <b>Дополнительно:</b> {{ $order->dop }}<br>
                @endif
            </td>
        </tr>
    </table>

    <h4>Заказ:</h4>
    <table class="table table-bordered table-sm">
        <tr>
            <th width="1%">ID</th>
            <th width="1%">Фото</th>
            <th>Блюдо</th>
            <th>Категория</th>
            <th>Цена за 1</th>
            <th>Сумма</th>
            <th>Кол-во</th>
        </tr>

        @php
            $total_quantity = 0;
            $total_price = 0;
        @endphp
        @foreach($order->dishes as $dish)
            <tr>
                <td>{{ $dish->id }}</td>
                <td width="1%" class="with-img">
                    @if(isset($dish->id) && Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_xxs.jpg'))
                        <img src="{{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_xxs.jpg') }}"
                             class="img-rounded rounded-circle"/>
                    @endif
                </td>
                <td>{{ $dish->name }}<br>
                    <i>({{ $dish->pivot->variants ? $dish->pivot->variants : $dish->short_description }})</i>
                </td>
                <td>{{ $dish->category->name }}</td>
                <td>{{ $dish->pivot->price }} ₽</td>
                <td>{{ $dish->pivot->total_price }} ₽</td>
                <td>{{ $dish->pivot->quantity }}</td>
            </tr>
            @php
                $total_quantity += $dish->pivot->quantity;
                $total_price += $dish->pivot->total_price;
            @endphp
        @endforeach
        <tr>
            <td colspan="5" class="text-right"></td>
            <td><b>{{ $total_price }} ₽</b></td>
            <td><b>{{ $total_quantity }}</b></td>
        </tr>

        <tr>
            <td colspan="6" class="text-right"><b>Итого:</b></td>
            <td><b>{{ $total_price }} ₽</b></td>
        </tr>

    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" onclick="print_order(this);">Распечатать</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
</div>
