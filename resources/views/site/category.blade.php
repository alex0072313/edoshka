@extends('layouts.site')

@section('content')
<section id="greetin_page_default"{!! Storage::disk('public')->exists('category_imgs/'.$category->id.'/src.jpg') ? ' style="background-image: url(\''.Storage::disk('public')->url('category_imgs/'.$category->id.'/src.jpg').'\');"' : '' !!}>
    <div class="container">

        <div class="d-flex align-content-end flex-wrap inner w-auto">

            <nav aria-label="breadcrumb" class="d-inline-block">
                {{--<ol class="breadcrumb">--}}
                    {{--<li class="breadcrumb-item"><a href="#">Рестораны Геленджика</a></li>--}}
                    {{--<li class="breadcrumb-item active" aria-current="page">Роллы</li>--}}
                {{--</ol>--}}
                {{ @Breadcrumbs::render() }}
            </nav>

            <div class="h1 w-100 font-weight-bolder text-white mb-3">
                @php
                    $var = 'town_'.$_town->id.'_category_'.$category->id.'_title';
                @endphp
                @helpmsg($var)
            </div>

        </div>

    </div>
</section>

<section id="shops">
    <div class="container">
        @foreach($restaurants as $restaurant)
            <div class="shop mb-5">

            <div class="shop_slider mb-5">
                <div class="shop_title mb-5">
                    <div class="h2 text-center mb-3">
                        {{ $category->name }} {{ $restaurant->name }}
                        {{--<span class="badge badge-primary"><i class="fas fa-thumbs-up fa-sm"></i> 104</span>--}}
                    </div>

                    {{--<div class="preview-review text-center">--}}
                        {{--<div class="d-inline-block lead px-3">--}}
                            {{--<a href="#" class="d-block text-secondary">--}}
                                {{--<i class="fas fa-comments fa-sm mr-2"></i>--}}
                                {{--Лучшее что я когда либо пробовал...--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                </div>
                <div class="shop_slider_inner" id="slider{{$restaurant->id}}">
                    @foreach($restaurant->dishes as $dish)
                        <div class="inner px-2">
                            @include('site.includes.dish')
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('site.restaurant', ['restaurant_alias' => $restaurant->alias]) }}" class="btn btn-lg btn-success">Меню</a>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection