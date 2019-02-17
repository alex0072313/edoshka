@extends('site.layouts.primary', [
    'title' => 'Главная',
])

@section('content')
    <section id="shops">
        <div class="container">
            <div class="shop mb-5">
                <div class="shop_slider mb-5">
                    <div class="shop_title mb-5">
                        <div class="h2 text-center mb-3">Популярно в Суши шторм <span class="badge badge-primary"><i class="fas fa-thumbs-up fa-sm"></i> 104</span></div>

                        <div class="preview-review text-center">

                            <div class="d-inline-block lead px-3">
                                <a href="#" class="d-block text-secondary">
                                    <i class="fas fa-comments fa-sm mr-2"></i>
                                    Лучшее что я когда либо пробовал...
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="shop_slider_inner" id="slider1">

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>
                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="#" class="btn btn-lg btn-success">Меню</a>
                </div>
            </div>
            <div class="shop mb-5">
                <div class="shop_slider mb-5">
                    <div class="shop_title mb-5">
                        <div class="h2 text-center mb-3">Популярно в Банзай <span class="badge badge-primary"><i class="fas fa-thumbs-up fa-sm"></i> 62</span></div>

                        <div class="preview-review text-center">
                            <div class="d-inline-block lead px-3">
                                <a href="#" class="d-block text-secondary">
                                    <i class="fas fa-comments fa-sm mr-2"></i>
                                    Роллы бесподобные, жаль соуса мало положили...
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="shop_slider_inner" id="slider2">

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>
                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="#" class="btn btn-lg btn-success">Меню</a>
                </div>
            </div>
            <div class="shop mb-5">
                <div class="shop_slider mb-5">
                    <div class="shop_title mb-5">
                        <div class="h2 text-center mb-3">Популярно в Обжорке <span class="badge badge-primary"><i class="fas fa-thumbs-up fa-sm"></i> 18</span></div>

                        <div class="preview-review text-center">
                            <div class="d-inline-block lead px-3">
                                <a href="#" class="d-block text-secondary">
                                    <i class="fas fa-comments fa-sm mr-2"></i>
                                    Всегда заказываем гиросы в офис, привезли горячие...
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="shop_slider_inner" id="slider3">

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>
                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="#" class="btn btn-lg btn-success">Меню</a>
                </div>
            </div>
            <div class="shop mb-5">
                <div class="shop_slider mb-5">
                    <div class="shop_title mb-5">
                        <div class="h2 text-center mb-3">Популярно в Суши Весла <span class="badge badge-primary"><i class="fas fa-thumbs-up fa-sm"></i> 10</span></div>

                        <div class="preview-review text-center">
                            <div class="d-inline-block lead px-3">
                                <a href="#" class="d-block text-secondary">
                                    <i class="fas fa-comments fa-sm mr-2"></i>
                                    Роллы большие, рекомендую брать запеченые...
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="shop_slider_inner" id="slider4">

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>
                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                        <div class="inner px-2">
                            @include('site.includes.product')
                        </div>

                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="#" class="btn btn-lg btn-success">Меню</a>
                </div>
            </div>
        </div>

    </section>
@endsection