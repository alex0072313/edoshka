@extends('site.layouts.primary', [
    'banner' => '/images/theme/slider2.jpg',
    'title' => 'Меню Суши шторм',
    'review' => 'Лучшее что я когда либо пробовал...',
    'about_link' => true,
    'breadcrumbs' => [
        'Главная',
        'Рестораны Геленджика',
        'Суши шторм',
    ]
])

@section('content')
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
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="products_group mt-4" id="products_group_2">
                            <div class="h2 mb-3 products_title">Ролы</div>
                            <div class="products_items">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="products_group mt-4" id="products_group_3">
                            <div class="h2 mb-3 products_title">Сеты</div>
                            <div class="products_items">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="products_group mt-4" id="products_group_4">
                            <div class="h2 mb-3 products_title">Пицца</div>
                            <div class="products_items">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        @include('site.includes.product')
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

