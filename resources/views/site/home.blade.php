
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="ZvBIZljQ8b6kjSDHX0WntJt6tFeWqUQ8AOIHWt22">

    <link rel="stylesheet" href="/css/app.css">

    <title>Главная</title>
</head>
<body>


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



<div class="h2 text-center mb-5">Доставка еды из ресторанов Геленджика</div>

<section id="shops_catalog" class="mb-5">
    <div class="container">
        <div class="catalog">
            <div class="row">

                <div class="col-lg-8 col-md-6 mb-4">
                    <div class="card text-white">
                        <a href="#">
                            <div class="badges">
                                <div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 104</div>
                            </div>
                            <div class="inner" style="background-image: url('/images/theme/slider3.jpg')">

                                <div class="card-img-overlay">
                                    <div class="h2 mb-0 products_title text-truncate mr-3">
                                        Суши Шторм
                                    </div>
                                    <div class="text-white-50 font-weight-light mb-2">
                                        Заказ от 700 &#8381;
                                    </div>

                                    <ul class="row list-unstyled mb-2">
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Роллы</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Суши</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Пицца</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> WOK</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Салаты</li>
                                    </ul>

                                    <div class="hover">
                                        <button class="btn btn-primary">Меню</button>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-white">
                        <a href="#">
                            <div class="badges">
                                <div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 62</div>
                            </div>
                            <div class="inner" style="background-image: url('/images/theme/slider3.jpg')">

                                <div class="card-img-overlay">
                                    <div class="h2 mb-0 products_title text-truncate mr-3">
                                        Банзай
                                    </div>
                                    <div class="text-white-50 font-weight-light mb-2">
                                        Заказ от 700 &#8381;
                                    </div>

                                    <ul class="row list-unstyled mb-2">
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Роллы</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Суши</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Пицца</li>
                                    </ul>

                                    <div class="hover">
                                        <button class="btn btn-primary">Меню</button>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="card text-white">
                        <a href="#">
                            <div class="badges">
                                <div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 18</div>
                            </div>
                            <div class="inner" style="background-image: url('/images/theme/slider3.jpg')">

                                <div class="card-img-overlay">
                                    <div class="h2 mb-0 products_title text-truncate mr-3">
                                        Обжорка
                                    </div>
                                    <div class="text-white-50 font-weight-light mb-2">
                                        Заказ от 700 &#8381;
                                    </div>

                                    <ul class="row list-unstyled mb-2">
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Пицца</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> WOK</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Салаты</li>
                                    </ul>

                                    <div class="hover">
                                        <button class="btn btn-primary">Меню</button>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 mb-4 mb-lg-0">
                    <div class="card text-white">
                        <a href="#">
                            <div class="badges">
                                <div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 10</div>
                            </div>
                            <div class="inner" style="background-image: url('/images/theme/slider3.jpg')">

                                <div class="card-img-overlay">
                                    <div class="h2 mb-0 products_title text-truncate mr-3">
                                        Суши Весла
                                    </div>
                                    <div class="text-white-50 font-weight-light mb-2">
                                        Заказ от 700 &#8381;
                                    </div>

                                    <ul class="row list-unstyled mb-2">
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Роллы</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Суши</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Пицца</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> WOK</li>
                                        <li class="col-md-6"><i class="fas fa-check fa-xs"></i> Салаты</li>
                                    </ul>

                                    <div class="hover">
                                        <button class="btn btn-primary">Меню</button>
                                    </div>

                                </div>
                            </div>
                        </a>
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


<script src="http://food.loc/js/app.js"></script>
</body>
</html>