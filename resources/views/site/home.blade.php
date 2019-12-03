@extends('layouts.site')

@push('head')
    <meta property="og:type" content="website"/>
    <meta  property="og:title" content="Доставка еды из лучших ресторанов Геленджика за 20-60 минут"/>
    <meta property="og:image" content="https://edoshka.ru/storage/category_imgs/5/src.jpg">
    <meta property="og:url" content= "http://edoshka.ru" />
    <meta property="og:description" content="Пицца, роллы, суши, гирос и другие блюда с доставкой в отель, на дом, в отель или в офис из лучших ресторанов Геленджика"/>
    <div itemscope itemtype ="http://schema.org/Organization" class="d-none">
        <meta itemprop="name" content="Edoshka" />
        <meta itemprop="address" content="Город Геленджик" />
        <div itemscope itemtype ="http://schema.org/Service">
            <meta itemprop="name" content="Доставка еды из лучших ресторанов Геленджика за 20-60 минут" />
            <meta itemprop="description" content="Пицца, роллы, суши, гирос и другие блюда с доставкой в отель, на дом, в отель или в офис из лучших ресторанов Геленджика" />
        </div>
        <div itemscope itemtype ="http://schema.org/Thing">
            <meta itemprop="name" content="Ресторан Добрый Повар" />
            <meta itemprop="description" content="Доставка еды из ресторана Добрый Повар в Геленджике на дом, в отель или в офис за 20-60 минут" />
            <a href="https://edoshka.ru/restaurant/dobryi-povar" itemprop="url">edoshka.ru/restaurant/dobryi-povar</a>
        </div>
        <div itemscope itemtype ="http://schema.org/Thing">
            <meta itemprop="name" content="Ресторан Farina Pizza" />
            <meta itemprop="description" content="Доставка еды из ресторана Farina Pizza в Геленджике на дом, в отель или в офис за 20-60 минут." />
            <a href="https://edoshka.ru/restaurant/farina-pizza" itemprop="url">edoshka.ru/restaurant/farina-pizza</a>
        </div>
        <div itemscope itemtype ="http://schema.org/Thing">
            <meta itemprop="name" content="Ресторан Гиро-King" />
            <meta itemprop="description" content="Доставка еды из ресторана Гиро-King в Геленджике на дом, в отель или в офис за 20-60 минут." />
            <a href="https://edoshka.ru/restaurant/giro-king" itemprop="url">edoshka.ru/restaurant/giro-king</a>
        </div>
        <div itemscope itemtype ="http://schema.org/Thing">
            <meta itemprop="name" content="Ресторан Автороллы Азия" />
            <meta itemprop="description" content="Доставка еды из ресторана Автороллы Азия в Геленджике на дом, в отель или в офис за 20-60 минут." />
            <a href="https://edoshka.ru/restaurant/aziya" itemprop="url">edoshka.ru/restaurant/aziya</a>
        </div>
    </div>
@endpush

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
                                                <a href="{{ $slide->href }}" onclick="analytics_action('slide');" class="btn btn-lg btn-success">Меню</a>
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

    <h1 class="h2 text-center mb-5">
        @php
            $var = 'town_'.$_town->id.'home_h1';
        @endphp
        @helpmsg($var)
    </h1>

    <section id="shops_catalog" class="mb-5">
        <div class="container">

            <div class="catalog">

                @if($restaurants_with_districts)
                    @foreach($restaurants_with_districts as $district_id => $restaurants)
                        <div class="h5 font-weight-light text-center my-3 text-secondary">{{ $districts->where('id', '=', $district_id)->first()->name }}</div>
                        <div class="row">
                            @foreach($restaurants as $restaurant)
                                <div class="col-sm-6 col-md-4 mb-4 text-sm-left text-center">
                                    <a href="{{ route('site.restaurant', ['restaurant_alias' => $restaurant->alias]) }}" class="item">
                                        <div class="th mb-2" style="background-image: url('{{ Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/src.jpg') }}')"></div>
                                        <div class="h4 text-body mb-1">{{ $restaurant->name }}</div>
                                        <div class="data">
                                            <div class="min_sum_order text-body">
                                                <i class="fas fa-shopping-cart fa-xs"></i> заказ от {{ $restaurant->min_sum_order }} ₽
                                            </div>
                                            @if($restaurant->kitchens)
                                                <div class="cats">
                                                    <span class="text-secondary font-weight-light">{{ implode(' • ', $restaurant->kitchens) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif

                @if($restaurants_without_districts)
                    @if(count($restaurants_with_districts))
                        <div class="h5 font-weight-light text-center my-3 text-secondary">Остальные районы</div>
                    @endif
                    <div class="row">
                        @foreach($restaurants_without_districts as $restaurant)
                            <div class="col-sm-6 col-md-4 mb-4 text-sm-left text-center">
                                <a href="{{ route('site.restaurant', ['restaurant_alias' => $restaurant->alias]) }}" class="item">
                                    <div class="th mb-2" style="background-image: url('{{ Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/src.jpg') }}')"></div>
                                    <div class="h4 text-body mb-1">{{ $restaurant->name }}</div>
                                    <div class="data">
                                        <div class="min_sum_order text-body">
                                            <i class="fas fa-shopping-cart fa-xs"></i> заказ от {{ $restaurant->min_sum_order }} ₽
                                        </div>
                                        @if($restaurant->kitchens)
                                            <div class="cats">
                                                <span class="text-secondary font-weight-light">{{ implode(' • ', $restaurant->kitchens) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            @php
                $var = 'town_'.$_town->id.'home_text';
            @endphp
            @helpmsg($var)

            @php
                $var = 'town_'.$_town->id.'_balls_info';
            @endphp
            @helpmsg($var)

        </div>
    </section>
@endsection

@push('js')
    <script>
        function shops_catalog_resize(){
            $('#shops_catalog .card .inner').each(function () {
                var box = $(this),
                    overlay = box.find('.card-img-overlay');
                box.css('height', overlay.innerHeight());
            });
        }
        $(window).on('resize', shops_catalog_resize).resize();
    </script>
@endpush
