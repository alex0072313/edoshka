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
                                    <li class="nav-item"><a class="nav-link{!! stristr(Route::currentRouteName(), 'customer.home') ? ' active': '' !!}" href="{{ route('customer.home') }}">Главная</a></li>
                                    <li class="nav-item"><a class="nav-link{!! stristr(Route::currentRouteName(), 'customer.profile') ? ' active': '' !!}" href="{{ route('customer.profile') }}">Профиль</a></li>
                                    {{--<li class="nav-item"><a class="nav-link" href="#">Мои заказы</a></li>--}}
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
                    <div class="d-none d-md-block filter">

                        <div class="nav_outer">

                            <div class="d-flex border-bottom pb-3 pt-0 mb-3 align-items-center">
                                <div class="mr-2">
                                    @if(Storage::disk('public')->exists('user_imgs/'.$_user->id.'/thumb_xs.jpg'))
                                        <img src="{{ Storage::disk('public')->url('user_imgs/'.$_user->id.'/thumb_xs.jpg') }}" class="rounded-circle" alt="">
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="font-weight-light mb-0">{{ $_user->fullname }}</h4>

                                    <a href="jsvascript:;" data-toggle="modal" data-target="#user_balls_info" >
                                        <small>
                                            <i class="fas fa-coins fa-sm"></i> {{ $_user->balls }} {{ plural(['балл', 'балла', 'баллов'], $_user->balls) }}
                                        </small>
                                    </a>
                                    @push('modals')
                                        <div class="modal fade product" id="user_balls_info" tabindex="-1" role="dialog" aria-labelledby="user_balls_info_title" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                                    </button>

                                                    <div class="modal-body">
                                                        <div class="h2 mb-4" id="user_balls_info_title">Для чего нужны баллы?</div>
                                                        @php
                                                            $var = 'town_'.$_town->id.'_balls_info';
                                                        @endphp
                                                        @helpmsg($var)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush

                                </div>
                            </div>

                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link{!! stristr(Route::currentRouteName(), 'customer.home') ? ' active': '' !!}" href="{{ route('customer.home') }}">Главная</a></li>
                                <li class="nav-item"><a class="nav-link{!! stristr(Route::currentRouteName(), 'customer.profile') ? ' active': '' !!}" href="{{ route('customer.profile') }}">Профиль</a></li>
{{--                                <li class="nav-item"><a class="nav-link{!! stristr(Route::currentRouteName(), 'customer.orders') ? ' active': '' !!}" href="{{ route('customer.orders') }}">Мои заказы</a></li>--}}
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">

                    @if(session('success'))
                        <div class="alert alert-primary fade show m-b-10">
                            <span class="close" data-dismiss="alert">×</span>
                            {!! session('success') !!}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger fade show m-b-10">
                            <span class="close" data-dismiss="alert">×</span>
                            {!! session('error') !!}
                        </div>
                    @endif

                    @yield('customer_content')
                </div>
            </div>

        </div>
    </section>
@endsection
