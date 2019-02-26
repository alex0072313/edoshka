@extends('layouts.site')

@section('content')
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
@endsection