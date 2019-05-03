@extends('layouts.site', ['body_class'=>'account_page'])

@section('content')
    <section id="greetin_page_default" class="shop" style="background-image: url('/assets/img/theme/customer.jpg');">
        <div class="container">
            <div class="d-flex align-content-end flex-wrap inner w-auto">
                <nav aria-label="breadcrumb" class="d-inline-block mx-auto mx-md-0">
                    {{ @Breadcrumbs::render() }}
                </nav>
                <div class="h1 w-100 font-weight-bolder text-white mb-3 text-md-left text-center">
                    {{ $longtitle ?: $title }}
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="mb-5">

        <div class="filter_mobile d-md-none d-block">
            <div class="container">
                <div class="inner d-flex">
                    <a href="jajascript:;" class="open"><i class="fas fa-angle-down"></i></a>
                    <a href="jajascript:;" class="close"><i class="fas fa-times"></i></a>
                    <div class="flex-grow-1">
                        <div class="flex-column">
                            <div class="nav_outer custom_scrollbar">
                                <ul class="products_nav products_nav_mobile links">
                                    <li class="nav-item"><a class="nav-link" href="#">Профиль</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Мои заказы</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter d-none d-md-block">

                        <div class="nav_outer custom_scrollbar">
                            <ul class="nav flex-column mt-3">
                                <li class="nav-item"><a class="nav-link" href="#">Профиль</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Мои заказы</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">
                    @yield('customer_content')
                </div>
            </div>

        </div>
    </section>
@endsection
