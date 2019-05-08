@extends('layouts.customer')

@section('customer_content')
    <div class="h2 mb-4">История заказов на сайте</div>

    @if($orders->count())

    @else
        <div class="lead">Заказов еще не было</div>
    @endif

@endsection
