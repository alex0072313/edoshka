<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="hpT1J0kae67aXUGjLUKhO6b4daAUPN6cD86Ll9cl">
    <link rel="stylesheet" href="/css/app.css">
    <title>Меню Суши шторм</title>
</head>
<body class="card__module_show">

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
                    <div class="city_select text-right">
                        <label class="mb-0">
                            <spnan class="d-lg-inline d-none">Ваш город</spnan> <a href="#">Геленджик <i class="fas fa-caret-down"></i></a>
                        </label>
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

<section id="greetin_page_default" class="shop" style="background-image: url(/images/theme/slider2.jpg);">
    <div class="container position-relative h-100">
        <div class="d-flex align-content-end flex-wrap inner w-auto">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Рестораны Геленджика</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Суши шторм</li>
                </ol>
            </nav>

            <div class="d-sm-flex w-100">
                <div class="clearfix flex-grow-1">
                    <div class="h1 font-weight-bolder text-white float-left shop_title mb-0">
                        Меню Суши шторм
                    </div>
                    <div class="float-left text-white bg-primary px-1 shop_likes">
                        <i class="fas fa-thumbs-up fa-sm"></i> 163
                    </div>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="btn btn-outline-light btn-sm d-inline-block d-sm-none my-2" id="dropdown_shop_info" data-boundary="window" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-info-circle mr-1"></i> О ресторане</button>

                        <button class="btn btn-outline-light btn-sm text-left shop_info_btn d-none d-sm-inline-block" id="dropdown_shop_info" data-boundary="window" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex">
                                <div class="mr-2"><i class="fas fa-info-circle"></i></div>
                                <div class="font-weight-light">Информация<br>о ресторане</div>
                            </div>
                        </button>

                        <div class="dropdown-menu p-2 shop_info_dropdown">
                            <div class="inner_dropdown">
                                <h5>Кафе доставки японской кухни</h5>
                                <ul class="list-unstyled mb-2">
                                    <li><i class="fas fa-check fa-xs text-primary mr-1"></i> Японская кухня</li>
                                    <li><i class="fas fa-check fa-xs text-primary mr-1"></i> Супы</li>
                                    <li><i class="fas fa-check fa-xs text-primary mr-1"></i> Салаты</li>
                                    <li><i class="fas fa-check fa-xs text-primary mr-1"></i> Суши</li>
                                    <li><i class="fas fa-check fa-xs text-primary mr-1"></i> Напитки</li>
                                </ul>
                                Адрес: 353460, Российская федерация, г. Геленджик
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-2 w-100 text-white-50 font-weight-light shop_min_price">
                заказ от 1000 ₽
            </div>

            <div class="w-100 shop_last_review py-4">
                <a href="#" class="d-block text-white">
                    <i class="fas fa-comments fa-sm mr-2"></i>
                    Лучшее что я когда либо пробовал...
                </a>
            </div>

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
                        <li class="nav-item">
                            <a class="nav-link active" href="#products_group_1">Популярное</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products_group_2">Роллы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products_group_3">Сеты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products_group_4">Пицца</a>
                        </li>
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
                        <li class="nav-item">
                            <a class="nav-link active" href="#products_group_1">Популярное</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products_group_2">Роллы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products_group_3">Сеты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products_group_4">Пицца</a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-md-9">
                <div class="products pt-2">

                    <div class="products_group" id="products_group_1">
                        <div class="h2 mb-3 products_title">Популярное</div>
                        <div class="products_items">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1444738244">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1444738244">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1420673561">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1420673561">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1635798928">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1635798928">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="882727052">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="882727052">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1413769151">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1413769151">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products_group mt-4" id="products_group_2">
                        <div class="h2 mb-3 products_title">Ролы</div>
                        <div class="products_items">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1323836162">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1323836162">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1553176510">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1553176510">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="612129917">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="612129917">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="984088608">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="984088608">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="150870305">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="150870305">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products_group mt-4" id="products_group_3">
                        <div class="h2 mb-3 products_title">Сеты</div>
                        <div class="products_items">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1422663902">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1422663902">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1115965869">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1115965869">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1871339793">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1871339793">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1929963743">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1929963743">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="750800664">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="750800664">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products_group mt-4" id="products_group_4">
                        <div class="h2 mb-3 products_title">Пицца</div>
                        <div class="products_items">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="1415856743">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="1415856743">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="168555922">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="168555922">В корзину</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="shop_pos_item p-2" data-product-id="627152287">
                                        <div class="image">
                                            <div class="badges">
                                                <div class="new">NEW</div>
                                                <div class="top">TOP</div>
                                            </div>

                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="title font-weight-bold">
                                            Роллы "Вулкан"
                                        </div>
                                        <div class="params text-secondary">
                                            270/8 шт
                                        </div>
                                        <div class="price d-flex justify-content-between">
                                            <div class="h4 mb-0">99 &#8381;</div>
                                            <div>
                                                <button class="btn btn-success btn-sm add_to_cart" data-product-id="627152287">В корзину</button>
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
    </div>
</section>

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

{{--Корзина--}}
@include('site.includes.card_module')

<script src="/js/app.js"></script>
</body>
</html>