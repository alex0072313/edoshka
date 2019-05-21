@extends('layouts.site', ['body_class'=>'category_page'])

@section('content')
    <section id="greetin_page_default" class="shop" style="background-image: url('/images/theme/404.jpg');">
        <div class="container">
            <div class="d-flex align-content-end flex-wrap inner w-auto">
                <div class="h1 w-100 font-weight-bolder text-white mb-3">
                    Такой страницы не существует :(
                </div>
                <div class="mb-3 mt-3 mb-md-5 w-100 text-white-50 font-weight-light shop_min_price text-md-left text-center">
                    Вы попали сюда по ошибке
                </div>
            </div>
        </div>
    </section>

    <section id="article" class="mb-5">
        <div class="container">
            <h2 class="h2 mb-3 text-primary text-md-left text-center mt-0 mt-sm-3">Попробуйте наши популярные блюда:</h2>
            @php
                $restaurants = \App\Restaurant::Active()->get();
                $pops = collect();
                foreach ($restaurants as $restaurant){
                    if($restaurant_from_cache = \Cache::get('restaurant_'.$restaurant->id.'_categories_dishes')){

                        $dishes = $restaurant->dishes;
                        $orders_ids = $restaurant->orders->map(function ($order){
                            return $order->id;
                        })->toArray();
                        $dishes_orders = \DB::table('dishes_orders')->select(['dish_id'])->whereIn('order_id', $orders_ids)->groupBy(['dish_id'])->get();

                        $dishes_pop = $dishes
                        ->filter(function ($dish) use ($dishes_orders){
                            return $dishes_orders->where('dish_id', '=', $dish->id)->count() ? true : false;
                        });
                        $pops = $pops->merge($dishes_pop);
                    }
                }

                $pops = $pops->sortBy(function($dish) use ($dishes_orders){
                    return $dishes_orders->where('dish_id', '=', $dish->id)->count();
                })->take(8);
            @endphp

            @if($pops->count())
                <div class="products_group" id="products_group_pop">
                    {{--<h2 class="h2 mb-3 products_title text-md-left text-center ">Популярно в ресторане {{ $restaurant->name }}</h2>--}}
                    <div class="products_items">
                        <div class="row mr-0">
                            @foreach($pops as $dish)
                                <div class="col-6 col-sm-4 col-md-4 col-lg-3 px-0 pl-3 mb-3">
                                    @include('site.includes.dish')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <p>Или ..</p>
            <div><a href="{{ route('site.home') }}" class="btn btn-primary btn-lg">Вернуться на главную</a></div>
        </div>
    </section>

@endsection

{{--@extends('errors::minimal')--}}

{{--@section('title', __('Not Found'))--}}
{{--@section('code', '404')--}}
{{--@section('message', __('Not Found'))--}}
