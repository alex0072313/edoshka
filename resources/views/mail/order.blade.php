@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
    {{ env('APP_NAME') }}: Новый заказ
@endcomponent
@endslot

{{-- Body --}}
# Заказ #{{ $order_id }}
@isset($dishes)
@component('mail::table')
    | id | Название | Доп. | Цена | Кол-во |
    | :- |:---------| :----| :----| ------:|
    @foreach($dishes as $dish)
        | {{ $dish->id }} | {{ $dish->name }} | {{ $dish->short_description }} | {{ $dish->price }} | {{ $dish->pivot->quantity }} |
    @endforeach
    | | | | <b>Сумма</b> &nbsp; <td align="right"> <b>{{ $total_price }}</b>
@endcomponent
@endisset

# Данные оформителя
@isset($phone)
* <b>Телефон:</b> {{ $phone }}
@endisset
@isset($name)
* <b>Имя:</b> {{ $name }}
@endisset
@isset($persons)
* <b>Кол-во приборов:</b> {{ $persons }}
@endisset
@isset($email)
* <b>Email:</b> {{ $email }}
@endisset
@isset($street)
* <b>Улица:</b> {{ $street }}
@endisset
@isset($home)
* <b>Дом:</b> {{ $home }}
@endisset
@isset($dop)
* <b>Дополнительно:</b> {{ $dop }}
@endisset

@component('mail::button', ['url' => $orders_url])
    Все заказы ресторана
@endcomponent

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
    @component('mail::subcopy')
        {{ $subcopy }}
    @endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
    © {{ date('Y') }} {{ config('app.name') }}. Система заказа еды
@endcomponent
@endslot
@endcomponent
