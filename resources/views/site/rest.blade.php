@extends('site.layouts.primary', [
    'banner' => '/images/theme/town.jpg',
    'title' => 'Где заказать еду в Геленджике',
    'lead' => 'Заказать в Геленджике',
    'breadcrumbs' => [
        'Главная',
        'Рестораны Геленджика',
    ]
])

@section('content')
    <section id="shops_catalog" style="height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter">

                        <div class="filter_group">

                            <div class="title">
                                <div class="h5 mb-3">Кухни</div>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="coo1">
                                <label class="custom-control-label" for="coo1">Пицца</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="coo2">
                                <label class="custom-control-label" for="coo2">Роллы</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="coo3">
                                <label class="custom-control-label" for="coo3">Суши</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="coo4">
                                <label class="custom-control-label" for="coo4">Сеты</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="coo5">
                                <label class="custom-control-label" for="coo5">WOK</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="coo6">
                                <label class="custom-control-label" for="coo6">Салаты</label>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="coo7">
                                <label class="custom-control-label" for="coo7">Фастфуд</label>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-9">

                    {{--<div class="sort mb-3">--}}
                        {{--Сортировать по: <a href="javascript:;">рейтингу</a> <a href="javascript:;">минимальной сумме заказа</a>--}}
                    {{--</div>--}}

                    <div class="catalog">
                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <div class="card text-white">
                                    <a href="#">
                                        <div class="badges">
                                            <div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 104</div>
                                        </div>
                                        <div class="inner">
                                            <img src="/images/theme/slider3.jpg" class="card-img" alt="...">

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
                            <div class="col-md-6 mb-4">
                                <div class="card text-white">
                                    <a href="#">
                                        <div class="badges">
                                            <div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 62</div>
                                        </div>
                                        <div class="inner">
                                            <img src="/images/theme/slider3.jpg" class="card-img" alt="...">

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
                            <div class="col-md-6 mb-4">
                                <div class="card text-white">
                                    <a href="#">
                                        <div class="badges">
                                            <div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 18</div>
                                        </div>
                                        <div class="inner">
                                            <img src="/images/theme/slider3.jpg" class="card-img" alt="...">

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
                            <div class="col-md-6 mb-4">
                                <div class="card text-white">
                                    <a href="#">
                                        <div class="badges">
                                            <div class="top"><i class="fas fa-thumbs-up fa-xs"></i> 10</div>
                                        </div>
                                        <div class="inner">
                                            <img src="/images/theme/slider3.jpg" class="card-img" alt="...">

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
            </div>
        </div>
    </section>
@endsection