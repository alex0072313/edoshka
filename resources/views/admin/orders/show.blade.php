<table class="table">
    <tr>
        <th width="1%" class="pr-0 border-top-0">ID</th>
        <th width="1%" class="pr-0 border-top-0"></th>
        <th class="border-top-0">Название</th>
        <th class="border-top-0">Категория</th>
        <th class="border-top-0">Цена за позицию</th>
        <th class="border-top-0">Сумма</th>
        <th class="border-top-0">Кол-во</th>
    </tr>

    @php
        $total_quantity = 0;
        $total_price = 0;
    @endphp
    @foreach($order->dishes as $dish)
        <tr>
            <td class="pr-0">{{ $dish->id }}</td>
            <td width="1%" class="with-img">
                @if(isset($dish->id) && Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_xxs.jpg'))
                    <img src="{{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_xxs.jpg') }}" class="img-rounded rounded-circle" />
                @endif
            </td>
            <td>{{ $dish->name }}</td>
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
        <td colspan="5" class="text-right"><b>Итого:</b></td>
        <td><b>{{ $total_price }} ₽</b></td>
        <td><b>{{ $total_quantity }}</b></td>
    </tr>

</table>
