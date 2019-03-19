<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="/images/theme/fav.png" rel="icon" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>{{ $title }}</title>
</head>
<body class="{!! count($_cart_content) ? 'card__module_show ' : '' !!}{!! isset($body_class) ? $body_class : '' !!}">
<header>
    <div class="top py-2">
        <div class="container">
            <div class="row">

                <div class="logo col-2 col-lg-3">
                    <a href="{{ route('site.home') }}" class="d-inline-block pb-2 pt-md-2 pt-3">
                        <img src="/images/theme/logo.png" alt="">
                    </a>
                </div>

                <div class="d-md-none search col-10">
                    <div class="text-right mb-2">
                        @if($_user)
                            <a href="{{ route('admin.home') }}" >
                                <i class="far fa-user"></i> Кабинет
                            </a>
                        @else
                            <a href="{{ route('login') }}" >
                                <span class="icon"></span> Войти
                            </a>
                        @endif
                    </div>
                    @include('site.includes.search_module', ['igp_clases'=>'ml-5'])
                </div>

                <div class="mx-auto col-md-8 col-lg-6 mt-2 mt-md-0">
                    <div class="globalmenu">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between links">
                            @foreach($top_categories as $category)
                                <a href="{{ route('site.category', ['category_alias'=>$category->alias]) }}">
                                    <span><img src="{{ $category->icon }}" alt=""></span>
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 d-none d-md-block">
                    <div class="account text-right">
                        @if($_user)
                            <a href="{{ route('admin.home') }}" class="inner text-center d-inline-block p-2">
                                <span class="icon"></span><br>
                                Кабинет
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inner text-center d-inline-block p-2">
                                <span class="icon"></span><br>
                                Войти
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-2 d-none d-md-block">
                <div class="mx-auto col-md-8 col-lg-6 search">
                    @include('site.includes.search_module')
                </div>
            </div>

        </div>
    </div>

</header>
@yield('content')
<footer>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-lg-0 mb-3">
                @php
                    $var = 'foot_block_1';
                @endphp
                <div class="h4 font-weight-light text-uppercase">@helpmsg($var)</div>
                <ul class="list-unstyled font-weight-light mb-0">
                    <li>
                        <a href="#">Заявка на сотрудничество</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.home') }}">Войти в личный кабинет</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-4 mb-lg-0 mb-3">
                @php
                    $var = 'foot_block_2';
                @endphp
                <div class="h4 font-weight-light text-uppercase">@helpmsg($var)</div>
                <ul class="list-unstyled font-weight-light mb-0">
                    <li>
                        <a href="#">Публичная оферта</a>
                    </li>
                    <li>
                        <a href="#">Пользовательское соглашение</a>
                    </li>
                    <li>
                        <a href="#">Политика конфиденциальности</a>
                    </li>
                </ul>
            </div>
            {{--<div class="col-md-6 col-lg-3 mb-lg-0 mb-3">--}}
                {{--<div class="h4 font-weight-light text-uppercase">Мы в соц сетях</div>--}}

                {{--<div class="socials">--}}
                    {{--<a href="#"><i class="fab fa-vk"></i></a>--}}
                    {{--<a href="#"><i class="fab fa-instagram"></i></a>--}}
                    {{--<a href="#"><i class="fab fa-facebook-f"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="col-md-12 col-lg-4 font-weight-light">
                @php
                    $var = 'foot_info';
                @endphp
                @helpmsg($var)
            </div>
        </div>
    </div>
    <div class="powered text-center">
        @php
            $var = 'copirate';
        @endphp
        @helpmsg($var)
    </div>
</footer>
@stack('modals')

@include('site.includes.card_module')
@include('site.includes.massage_module')

<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>