@extends('layouts.site')

@section('content')
    @if(count($slides))
        <section id="greetin">
            <div class="slider autoHeight">
                @foreach($slides as $slide)
                    <div>
                        <div class="slide" style="background-image: url('{{ Storage::disk('public')->url('slide_imgs/'.$slide->id.'/src.jpg') }}');">
                            <div class="container">
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex align-content-sm-center align-content-end flex-wrap inner text-center">
                                        @if($slide->title)
                                            <div class="h1 w-100 mb-3 font-weight-bolder text-white mt-5">{!! $slide->title !!}</div>
                                        @endif
                                        @if($slide->href)
                                            <div class="w-100 mb-3">
                                                <a href="{{ $slide->href }}" class="btn btn-lg btn-success">Меню</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <div class="h2 text-center mb-5">Доставка еды из ресторанов Геленджика</div>

    <section id="shops_catalog" class="mb-5">
        <div class="container">
            <div class="catalog">
                <div class="row">
                    @php
                        $i = 0;
                    @endphp
                    @foreach($restaurants as $restaurant)
                        @php
                            if(count($restaurants) > 3){
                                if($i % 2 == 0){
                                    $class = 'col-lg-8 col-md-6 mb-4';
                                }else{
                                    $class = 'col-lg-4 col-md-6 mb-4';
                                    $i--;
                                }
                            }else{
                                $class = 'col-lg-6 mb-4';
                            }
                        @endphp

                        <div class="{{ $class }}">
                            <div class="card text-white">
                                {{--<div class="badges">--}}
                                    {{--<div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 104</div>--}}
                                {{--</div>--}}

                                <div class="inner" style="background-image: url('{{ Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/src.jpg') }}')">
                                    <div class="card-img-overlay">
                                        <div class="h2 mb-0 products_title text-truncate mr-3">
                                            {{ $restaurant->name }}
                                        </div>
                                        @if($restaurant->min_sum_order)
                                            <div class="text-white-50 font-weight-light mb-2">
                                                Заказ от {{ $restaurant->min_sum_order }} &#8381;
                                            </div>
                                        @endif
                                        <ul class="row list-unstyled mb-2">
                                            @foreach($restaurant->cats as $category)
                                                <li class="col-md-6"><i class="fas fa-check fa-xs"></i> {{ $category->name }}</li>
                                            @endforeach
                                        </ul>
                                        <div class="hover">
                                            <a href="{{ route('site.restaurant', ['restaurant_alias' => $restaurant->alias]) }}" class="btn btn-primary">Меню</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $i++;
                        @endphp
                    @endforeach

                    {{--<div class="col-lg-8 col-md-6 mb-4">--}}
                        {{--<div class="card text-white">--}}
                            {{--<a href="#">--}}
                                {{--<div class="badges">--}}
                                    {{--<div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 104</div>--}}
                                {{--</div>--}}
                                {{--<div class="inner" style="background-image: url('/images/theme/slider3.jpg')">--}}

                                    {{--<div class="card-img-overlay">--}}
                                        {{--<div class="h2 mb-0 products_title text-truncate mr-3">--}}
                                            {{--Суши Шторм--}}
                                        {{--</div>--}}
                                        {{--<div class="text-white-50 font-weight-light mb-2">--}}
                                            {{--Заказ от 700 &#8381;--}}
                                        {{--</div>--}}

                                        {{--<ul class="row list-unstyled mb-2">--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Роллы</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Суши</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Пицца</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> WOK</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Салаты</li>--}}
                                        {{--</ul>--}}

                                        {{--<div class="hover">--}}
                                            {{--<button class="btn btn-primary">Меню</button>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{----}}
                    {{--<div class="col-lg-4 col-md-6 mb-4">--}}
                        {{--<div class="card text-white">--}}
                            {{--<a href="#">--}}
                                {{--<div class="badges">--}}
                                    {{--<div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 62</div>--}}
                                {{--</div>--}}
                                {{--<div class="inner" style="background-image: url('/images/theme/slider3.jpg')">--}}

                                    {{--<div class="card-img-overlay">--}}
                                        {{--<div class="h2 mb-0 products_title text-truncate mr-3">--}}
                                            {{--Банзай--}}
                                        {{--</div>--}}
                                        {{--<div class="text-white-50 font-weight-light mb-2">--}}
                                            {{--Заказ от 700 &#8381;--}}
                                        {{--</div>--}}

                                        {{--<ul class="row list-unstyled mb-2">--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Роллы</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Суши</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Пицца</li>--}}
                                        {{--</ul>--}}

                                        {{--<div class="hover">--}}
                                            {{--<button class="btn btn-primary">Меню</button>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{----}}
                    {{--<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">--}}
                        {{--<div class="card text-white">--}}
                            {{--<a href="#">--}}
                                {{--<div class="badges">--}}
                                    {{--<div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 18</div>--}}
                                {{--</div>--}}
                                {{--<div class="inner" style="background-image: url('/images/theme/slider3.jpg')">--}}

                                    {{--<div class="card-img-overlay">--}}
                                        {{--<div class="h2 mb-0 products_title text-truncate mr-3">--}}
                                            {{--Обжорка--}}
                                        {{--</div>--}}
                                        {{--<div class="text-white-50 font-weight-light mb-2">--}}
                                            {{--Заказ от 700 &#8381;--}}
                                        {{--</div>--}}

                                        {{--<ul class="row list-unstyled mb-2">--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Пицца</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> WOK</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Салаты</li>--}}
                                        {{--</ul>--}}

                                        {{--<div class="hover">--}}
                                            {{--<button class="btn btn-primary">Меню</button>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{----}}
                    {{--<div class="col-lg-8 col-md-6 mb-4 mb-lg-0">--}}
                        {{--<div class="card text-white">--}}
                            {{--<a href="#">--}}
                                {{--<div class="badges">--}}
                                    {{--<div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 10</div>--}}
                                {{--</div>--}}
                                {{--<div class="inner" style="background-image: url('/images/theme/slider3.jpg')">--}}

                                    {{--<div class="card-img-overlay">--}}
                                        {{--<div class="h2 mb-0 products_title text-truncate mr-3">--}}
                                            {{--Суши Весла--}}
                                        {{--</div>--}}
                                        {{--<div class="text-white-50 font-weight-light mb-2">--}}
                                            {{--Заказ от 700 &#8381;--}}
                                        {{--</div>--}}

                                        {{--<ul class="row list-unstyled mb-2">--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Роллы</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Суши</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Пицца</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> WOK</li>--}}
                                            {{--<li class="col-md-6"><i class="fas fa-check fa-xs"></i> Салаты</li>--}}
                                        {{--</ul>--}}

                                        {{--<div class="hover">--}}
                                            {{--<button class="btn btn-primary">Меню</button>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}




                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $('#shops_catalog .card .inner').each(function () {
            var box = $(this),
                overlay = box.find('.card-img-overlay');

            function shops_catalog_resize(box){
                box.css('height', overlay.innerHeight());
            }

            $(window).on('resize ready', shops_catalog_resize);
        });

    </script>
@endpush