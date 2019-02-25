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
<body{!! isset($body_class) ? ' class="'.$body_class.'"' : '' !!}>
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
                    @include('site.includes.search_module', ['igp_clases'=>'ml-5'])
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

                    <div class="account text-right">

                        <a href="{{ route('login') }}" class="inner text-center d-inline-block p-2">
                            <span class="icon"></span><br>
                            Войти
                        </a>

                    </div>

                    {{--<div class="city_select text-right">--}}
                        {{--<label class="mb-0">--}}
                            {{--<spnan class="d-lg-inline d-none">Ваш город</spnan> <a href="#">Геленджик <i class="fas fa-caret-down"></i></a>--}}
                        {{--</label>--}}
                    {{--</div>--}}

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

<div class="modal fade product" id="shop_pos_item_modal_1444738244" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1444738244" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1444738244">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1420673561" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1420673561" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1420673561">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1635798928" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1635798928" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1635798928">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_882727052" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_882727052" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_882727052">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1413769151" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1413769151" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1413769151">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1323836162" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1323836162" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1323836162">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1553176510" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1553176510" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1553176510">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_612129917" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_612129917" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_612129917">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_984088608" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_984088608" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_984088608">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_150870305" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_150870305" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_150870305">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1422663902" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1422663902" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1422663902">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1115965869" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1115965869" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1115965869">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1871339793" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1871339793" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1871339793">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1929963743" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1929963743" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1929963743">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_750800664" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_750800664" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_750800664">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_1415856743" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_1415856743" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_1415856743">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_168555922" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_168555922" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_168555922">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
<div class="modal fade product" id="shop_pos_item_modal_627152287" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_627152287" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_627152287">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
                            <div>
                                <button class="btn btn-success btn-lg">В корзину</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                        <div class="past">
                            <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан" Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recomend mt-2 pt-1">
                            <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                            <div class="items">
                                <div class="item d-flex align-items-center">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                                <div class="item d-flex align-items-center border-top">
                                    <div class="image">
                                        <img src="/images/theme/roll1.jpg" alt="">
                                    </div>
                                    <div class="flex-grow-1 ml-2 font-weight-bold">
                                        Роллы "Вулкан"
                                        <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                    </div>
                                    <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                    <div>
                                        <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>

@stack('modals')

@include('site.includes.card_module')

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>