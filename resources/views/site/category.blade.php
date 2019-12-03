@extends('layouts.site', ['body_class'=>'category_page'])

@section('content')
    <section id="greetin_page_default" class="shop"{!! Storage::disk('public')->exists('category_imgs/'.$category->id.'/src.jpg') ? ' style="background-image: url(\''.Storage::disk('public')->url('category_imgs/'.$category->id.'/src.jpg').'\');"' : '' !!}>
        <div class="container">
            <div class="d-flex align-content-end flex-wrap inner w-auto">
                <nav aria-label="breadcrumb" class="d-inline-block mx-auto mx-md-0">
                    {{ @Breadcrumbs::render() }}
                </nav>
                <div class="h1 w-100 font-weight-bolder text-white mb-3 text-md-left text-center">
                    @php
                        $var = 'town_'.$_town->id.'_category_'.$category->id.'_title';
                    @endphp
                    @helpmsg($var)
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="mb-5">

        <div class="filter_mobile d-md-none d-block">
            <div class="container">
                <div class="inner d-flex">
                    <a href="javascript:;" class="open"><i class="fas fa-angle-down"></i></a>
                    <a href="javascript:;" class="close"><i class="fas fa-times"></i></a>
                    <div class="flex-grow-1">
                        <div class="flex-column">
                            <div class="nav_outer custom_scrollbar">
                                <ul class="products_nav products_nav_mobile links">
                                    @foreach($categories as $_category)
                                        <li class="nav-item">
                                            <a class="nav-link{{ ($_category->id == $category->id) ? ' active' : '' }}" href="{{ route('site.category', $_category->alias) }}">{{ $_category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

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
                                    <input type="text" class="form-control form-control-lg holdered font-weight-light" id="products_search" value="Поиск по блюдам..">
                                </div>
                            </div>
                        </div>

                        <div class="nav_outer custom_scrollbar">
                            <ul class="nav flex-column mt-3">
                                @foreach($categories as $_category)
                                    <li class="nav-item">
                                        <a class="nav-link{{ ($_category->id == $category->id) ? ' active' : '' }}" href="{{ route('site.category', $_category->alias) }}">{{ $_category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="products pt-2">
                        @foreach($restaurants as $restaurant)
                            <div class="products_group{{ !$loop->first ? ' mt-4' : '' }}" id="products_group_{{ $category->id }}">
                                <div class="d-md-flex justify-content-between mb-3 mb-md-0 text-md-left text-center">
                                    <h2 class="h4 mb-3 products_title">
                                        {{ $category->name }} от ресторана {{ $restaurant->name }}
                                        @if($district = $restaurant->district)
                                            {{ $district->name3 ? ' в '.$district->name3 : '' }}
                                        @endif
                                    </h2>
                                    <div>
                                        <a href="{{ route('site.restaurant', $restaurant->alias) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-utensils mr-1"></i> Меню</a>
                                    </div>
                                </div>

                                <div class="products_items{{ ($restaurants->count() > 1) && ($restaurant->all_dishes->count() > 6) ? ' compact' : '' }}">
                                    <div class="row mr-0">
                                        @foreach($restaurant->all_dishes as $dish)
                                            <div class="col-6 col-sm-4 col-md-4 col-lg-3 px-0 pl-3 mb-3">
                                                @include('site.includes.dish', ['open_in_rest' =>true])
                                            </div>
                                        @endforeach
                                    </div>
                                    @if(($restaurants->count() > 1) && ($restaurant->all_dishes->count() > 6))
                                        <div class="mb-3 text-center">
                                            <a href="javascript:;" class="btn btn-dark products_items_show_more" onclick="products_show_more2(this);" data-switch="Показать еще|Свернуть">Показать еще</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @php
                $var = 'town_'.$_town->id.'_category_'.$category->id.'_content';
            @endphp
            @helpmsg($var)

            @php
                $var = 'town_'.$_town->id.'_balls_info';
            @endphp
            @helpmsg($var)

        </div>
    </section>

@endsection
