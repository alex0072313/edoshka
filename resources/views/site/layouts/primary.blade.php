<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>{{ $title }}</title>
</head>
<body>

    {{--Шапка--}}
    <header>
        <div class="top py-2">
            <div class="container">
                <div class="row">

                    <div class="logo col-2 col-lg-3">
                        <a href="#" class="d-inline-block py-2 ">
                            <img src="/images/theme/logo.png" alt="">
                        </a>
                    </div>

                    <div class="d-md-none search col-10">

                        <div class="text-right">
                            <label class="mb-0 font-weight-light">
                                Ваш город <a href="#">Геленджик <i class="fas fa-caret-down"></i></a>
                            </label>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend ml-5">
                                <div class="input-group-text"><img src="/images/theme/s_i.svg" width="16" height="16" alt=""></div>
                            </div>
                            <input type="text" class="form-control font-weight-light holdered" value="Поиск блюда.." >
                        </div>
                    </div>

                    <div class="mx-auto col-md-8 col-lg-6 mt-2 mt-md-0">
                        <div class="globalmenu">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between links">
                                <a href="#">
                                    <span><img src="/images/theme/pizza.svg" alt=""></span>
                                    Пицца
                                </a>
                                <a href="#">
                                    <span><img src="/images/theme/sushi-roll.svg" alt=""></span>
                                    Роллы
                                </a>
                                <a href="#">
                                    <span><img src="/images/theme/japanese-food.svg" alt=""></span>
                                    Суши
                                </a>
                                <a href="#">
                                    <span><img src="/images/theme/sushi.svg" alt=""></span>
                                    Сеты
                                </a>
                                <a href="#">
                                    <span><img src="/images/theme/wok.svg" alt=""></span>
                                    WOK`и
                                </a>
                                <a href="#">
                                    <span><img src="/images/theme/salad.svg" alt=""></span>
                                    Салаты
                                </a>
                                <a href="#">
                                    <span><img src="/images/theme/fast-food.svg" alt=""></span>
                                    Фастфуд
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2 d-none d-md-block">
                        <div class="city_select text-right">
                            <label class="mb-0">
                                <spnan class="d-lg-inline d-none">Ваш город</spnan> <a href="#">Геленджик <i class="fas fa-caret-down"></i></a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 d-none d-md-block">

                    <div class="mx-auto col-md-8 col-lg-6 search">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img src="/images/theme/s_i.svg" width="16" height="16" alt=""></div>
                            </div>
                            <input type="text" class="form-control font-weight-light holdered" value="Поиск блюда.." >
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </header>
    {{----}}

    @if(isset($banner))
        <section id="greetin_page_default" style="background-image: url({{ $banner }});">
            <div class="container position-relative h-100">

                <div class="d-flex align-content-end flex-wrap inner">

                    @if(isset($breadcrumbs))
                        <nav aria-label="breadcrumb" class="d-inline-block">
                            <ol class="breadcrumb">
                                @foreach($breadcrumbs as $breadcrumb)
                                    @if(!$loop->last)
                                        <li class="breadcrumb-item"><a href="#">{{ $breadcrumb }}</a></li>
                                    @else
                                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    @endif

                    <div class="h1 w-100 font-weight-bolder text-white mb-3">
                        {{ $title }}
                        @if(isset($about_link))
                            <a href="#" class="btn btn-success btn-sm ml-3">О ресторане</a>
                        @endif
                    </div>

                    @if(isset($review))
                            <div class="lead mb-3">
                                <a href="#" class="d-block text-white">
                                    <i class="fas fa-comments fa-sm mr-2"></i>
                                    Лучшее что я когда либо пробовал...
                                </a>
                            </div>
                        {{--<div class="w-100 mb-3 text-white">--}}
                            {{--<div class="lead">{{ $review }}</div>--}}
                        {{--</div>--}}
                    @endif
                </div>

            </div>
        </section>
    @else
        {{--Слайдер--}}
        <section id="greetin">
            <div class="slider autoHeight">
                <div>
                    <div class="slide" style="background-image: url('/images/theme/slider1.jpg');">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex align-content-sm-center align-content-end flex-wrap inner text-center">
                                    <div class="h1 w-100 mb-3 font-weight-bolder text-white mt-5">Доставка роллов из ресторанов Геленджика</div>
                                    <div class="w-100 mb-3">
                                        <div class="btn btn-lg btn-success">Меню</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="slide" style="background-image: url(/images/theme/slider2.jpg);">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex align-content-sm-center align-content-end flex-wrap inner text-center">
                                    <div class="h1 w-100 mb-3 font-weight-bolder text-white mt-5">Доставка пиццы в Геленджике</div>
                                    <div class="w-100 mb-3">
                                        <div class="btn btn-lg btn-success">Меню</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="slide" style="background-image: url(/images/theme/slider3.jpg);">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex align-content-sm-center align-content-end flex-wrap inner text-center">
                                    <div class="h1 w-100 mb-3 font-weight-bolder text-white mt-5">Заказать фастфуд в Геленджике</div>
                                    <div class="w-100 mb-3">
                                        <div class="btn btn-lg btn-success">Меню</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{----}}
    @endif

    @yield('content')

    <footer>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-lg-0 mb-3">
                    <div class="h4 font-weight-light text-uppercase">Партнерам</div>
                    <ul class="list-unstyled font-weight-light mb-0">
                        <li>
                            <a href="#">Заявка на сотрудничество</a>
                        </li>
                        <li>
                            <a href="#">Войти в личный кабинет</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 mb-lg-0 mb-3">
                    <div class="h4 font-weight-light text-uppercase">Правовая информация</div>
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
                <div class="col-md-6 col-lg-3 mb-lg-0 mb-3">
                    <div class="h4 font-weight-light text-uppercase">Мы в соц сетях</div>
                    
                    <div class="socials">
                        <a href="#"><i class="fab fa-vk"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>

                <div class="col-md-3 font-weight-light">
                    Информация на сайте edoshka.ru является публичной офертой.
                    Указанные цены действуют только при оформлении заказа через интернет-магазин edoshka.ru.
                </div>
            </div>
        </div>
        <div class="powered text-center">
            <small>2019  Все права защищены. <a href="#">Разрабготка site-forest.ru</a></small>
        </div>
    </footer>

    @stack('modals')

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>