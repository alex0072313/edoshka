@extends('layouts.site')

@section('content')
    <section id="greetin_page_default" class="shop" {!! Storage::disk('public')->exists('restaurant_imgs/'.$restaurant->id.'/src.jpg') ? ' style="background-image: url(\''.Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/src.jpg').'\');"' : '' !!}>
        <div class="container position-relative h-100">
            <div class="d-flex align-content-end flex-wrap inner w-100">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    {{ @Breadcrumbs::render() }}
                </nav>

                <div class="d-sm-flex w-100">
                    <div class="clearfix flex-grow-1">
                        <div class="h1 font-weight-bolder text-white float-left shop_title mb-0">
                            @php
                                $var = 'restaurant_'.$restaurant->id.'_title';
                            @endphp
                            @helpmsg($var)
                        </div>
                        {{--<div class="float-left text-white bg-primary px-1 shop_likes">--}}
                            {{--<i class="fas fa-thumbs-up fa-sm"></i> 163--}}
                        {{--</div>--}}
                    </div>
                    <div class="mr-4">
                        <div class="dropdown">
                            <button class="btn btn-outline-light btn-sm d-inline-block d-sm-none my-2" id="dropdown_shop_info" data-boundary="window" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-info-circle mr-1"></i> О ресторане</button>

                            <button class="btn btn-outline-light btn-sm text-left shop_info_btn d-none d-sm-inline-block" id="dropdown_shop_info" data-boundary="window" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="d-flex">
                                    <div class="mr-2"><i class="fas fa-info-circle"></i></div>
                                    <div class="font-weight-light">
                                        @php
                                            $var = 'restaurant_info_btn';
                                        @endphp
                                        @helpmsg($var)
                                    </div>
                                </div>
                            </button>

                            <div class="dropdown-menu p-2 shop_info_dropdown">
                                <div class="inner_dropdown">
                                    {!! $restaurant->description !!}
                                    @if($restaurant->address)
                                        Адрес: {{ $restaurant->address }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($restaurant->min_sum_order)
                    <div class="mb-5 w-100 text-white-50 font-weight-light shop_min_price">
                        заказ от {{ $restaurant->min_sum_order }} ₽
                    </div>
                @endif
                {{--<div class="w-100 shop_last_review py-4">--}}
                    {{--<a href="#" class="d-block text-white">--}}
                        {{--<i class="fas fa-comments fa-sm mr-2"></i>--}}
                        {{--Лучшее что я когда либо пробовал...--}}
                    {{--</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </section>
    <section id="products" class="mb-5">

        <div class="filter_mobile d-md-none d-block">
            <div class="container">

                <div class="inner d-flex">
                    <div class="pt-2 pr-2">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="flex-grow-1">
                        <ul class="nav flex-column products_nav">
                            @if($popular_dishes->count())
                                <li class="nav-item">
                                    <a class="nav-link active" href="#products_group_popular">Популярное</a>
                                </li>
                            @endif
                            @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link{{ $loop->first && !$popular_dishes->count() ? ' active' : '' }}" href="#products_group_{{ $category->id }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter d-none d-md-block">

                        <div class="search">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <img src="/images/theme/s_i_b.svg" width="16" height="16" alt="">
                                    </div>
                                    <input type="text" class="form-control form-control-lg holdered font-weight-light" id="products_search" value="Поиск по меню..">
                                </div>
                            </div>
                        </div>

                        <ul class="nav flex-column mt-3 products_nav">
                            @if($popular_dishes->count())
                                <li class="nav-item">
                                    <a class="nav-link active" href="#products_group_popular">Популярное</a>
                                </li>
                            @endif
                            @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link{{ $loop->first && !$popular_dishes->count() ? ' active' : '' }}" href="#products_group_{{ $category->id }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="products pt-2">
                        @if($popular_dishes->count())
                        <div class="products_group" id="products_group_popular">
                            <div class="h2 mb-3 products_title">Популярное</div>
                            <div class="products_items">
                                <div class="row">
                                    @foreach($popular_dishes as $dish)
                                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                            @include('site.includes.dish')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        @foreach($categories as $category)
                            <div class="products_group mt-4" id="products_group_{{ $category->id }}">
                                <div class="h2 mb-3 products_title">{{ $category->name }}</div>
                                <div class="products_items">
                                    <div class="row">
                                        @foreach($category->dishes as $dish)
                                            <div class="col-md-4 mb-4">
                                                @include('site.includes.dish')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection