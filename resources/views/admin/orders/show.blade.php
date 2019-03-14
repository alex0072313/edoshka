<table class="table">
    <tr>
        <th width="1%" class="pr-0 border-top-0">ID</th>
        <th width="1%" class="pr-0 border-top-0"></th>
        <th class="border-top-0">Название</th>
        <th class="border-top-0">Категория</th>
        <th class="border-top-0">Сумма</th>
        <th class="border-top-0">Кол-во</th>
    </tr>

    @foreach($order->dishes as $dish)
        <td class="pr-0">{{ $dish->id }}</td>
        <td width="1%" class="with-img">
            @if(isset($dish->id) && Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_xxs.jpg'))
                <img src="{{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_xxs.jpg') }}" class="img-rounded rounded-circle" />
            @endif
        </td>
        <td>{{ $dish->name }}</td>
        <td>{{ $dish->category->name }}</td>
        <td>{{ $dish->price }}</td>
        <td>{{ $dish->pivot->quantity }}</td>
    @endforeach
    <tr>
        <td colspan="4" class="text-right"><b>Итого:</b></td>
        <td><b>1</b></td>
        <td><b>1</b></td>
    </tr>


</table>