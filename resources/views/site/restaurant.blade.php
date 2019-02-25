@extends('site.layouts.primary', ['body_class'=>'card__module_show'])

@section('content')
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
@endsection