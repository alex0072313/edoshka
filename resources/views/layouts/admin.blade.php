<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="/images/theme/fav.png" rel="icon" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/font-awesome/5.2/css/all.min.css" rel="stylesheet" />
    <link href="/assets/plugins/animate/animate.min.css" rel="stylesheet" />
    <link href="/assets/css/default/style.min.css" rel="stylesheet" />
    <link href="/assets/css/default/style-responsive.min.css" rel="stylesheet" />
    <link href="/assets/css/default/theme/orange.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <link href="/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

    <link href="/assets/css/style.css" rel="stylesheet" />

    @stack('css')

</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar-default">

        <!-- begin navbar-header -->
        <div class="navbar-header">
            <a href="{{ route('site.home') }}" class="navbar-brand"><img src="{{ asset('/images/theme/logo_b.svg') }}" alt=""></a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end navbar-header -->

        <!-- begin header-nav -->
        <ul class="navbar-nav navbar-right">

            {{--<li>--}}
                {{--<form class="navbar-form">--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="text" class="form-control" placeholder="Enter keyword" />--}}
                        {{--<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</li>--}}

            {{--<li class="dropdown">--}}
                {{--<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">--}}
                    {{--<i class="fa fa-bell"></i>--}}
                    {{--<span class="label">0</span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu media-list dropdown-menu-right">--}}
                    {{--<li class="dropdown-header">NOTIFICATIONS (0)</li>--}}
                    {{--<li class="text-center width-300 p-b-10">--}}
                        {{--No notification found--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="dropdown navbar-user">--}}
                {{--<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">--}}
                    {{--<div class="image image-icon bg-black text-grey-darker">--}}
                        {{--<i class="fa fa-user"></i>--}}
                    {{--</div>--}}
                    {{--<span class="d-none d-md-inline">Adam Schwartz</span> <b class="caret"></b>--}}
                {{--</a>--}}
                {{--<div class="dropdown-menu dropdown-menu-right">--}}
                    {{--<a href="javascript:;" class="dropdown-item">Edit Profile</a>--}}
                    {{--<a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>--}}
                    {{--<a href="javascript:;" class="dropdown-item">Calendar</a>--}}
                    {{--<a href="javascript:;" class="dropdown-item">Setting</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a href="javascript:;" class="dropdown-item">Log Out</a>--}}
                {{--</div>--}}
            {{--</li>--}}


            <li>
                <a href="{{ route('admin.logout') }}" title="Выйти с кабинета">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>

        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">

            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <a href="javascript:;" data-toggle="nav-profile">

                        @if(!$is_megaroot)
                            <div class="cover with-shadow"{!! Storage::disk('public')->exists('restaurant_imgs/'.$_restaurant->id.'/thumb_m.jpg') ? ' style="background-image:url('.Storage::disk('public')->url('restaurant_imgs/'.$_restaurant->id.'/thumb_m.jpg').');"' : ''!!}></div>
                        @endif

                        @if(Storage::disk('public')->exists('user_imgs/'.$_user->id.'/thumb_s.jpg'))
                            <div class="image image-icon">
                                <img src="{{ Storage::disk('public')->url('user_imgs/'.$_user->id.'/thumb_s.jpg') }}" alt="">
                            </div>
                        @else
                            <div class="image image-icon bg-black text-grey-darker">
                                <i class="fas fa-user-alt"></i>
                            </div>
                        @endif

                        <div class="info">
                            <b class="caret pull-right"></b>
                            @if(!$is_megaroot)
                                {{ $_restaurant->name }}
                                <small>{!! ($_user->lastname ? $_user->lastname.'&nbsp' : '') . $_user->name !!} ({{ config('role.names.'.$_user->roles()->get()->first()->name.'.dolg') }})</small>
                            @else
                                {!! ($_user->lastname ? $_user->lastname.'&nbsp' : '') . $_user->name !!}
                                <small>({{ config('role.names.'.$_user->roles()->get()->first()->name.'.dolg') }})</small>
                            @endif
                        </div>
                    </a>
                </li>
                <li>
                    <ul class="nav nav-profile">

                        <li><a href="{{ route('admin.users.edit', $_user->id) }}"><i class="fa fa-cog"></i> Профиль пользователя</a></li>

                        @if($_user->hasRole('megaroot|boss') && isset($_restaurant->name))
                            <li><a href="{{ route('admin.restaurants.edit', $_restaurant->id) }}"><i class="fas fa-map-marked-alt"></i> Данные ресторана</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            <!-- end sidebar user -->

            <!-- begin sidebar nav -->
            <ul class="nav">
                <li class="nav-header">Управление</li>

                <li{!! Route::currentRouteName() == 'admin.home' ? ' class="active"': '' !!}>
                    <a href="{{ route('admin.home') }}">
                        <i class="fas fa-file-invoice"></i>
                        <span>Заказы</span>
                    </a>
                </li>

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.towns') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.towns.index') }}">
                            <i class="fas fa-map-signs"></i>
                            <span>Города</span>
                        </a>
                    </li>
                @endif

                @if($_user->hasRole('megaroot'))
                    <li{!! stristr(Route::currentRouteName(), 'admin.present') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.presents.index') }}">
                            <i class="fas fa-user-tie"></i>
                            <span>Представители</span>
                        </a>
                    </li>
                @endif

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.restaurants') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.restaurants.index') }}">
                            <i class="fas fa-university"></i>
                            <span>Рестораны</span>
                        </a>
                    </li>
                @endif

                @if($_user->hasRole('megaroot|boss'))
                    <li{!! stristr(Route::currentRouteName(), 'admin.users') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users"></i>
                            <span>{{ $is_megaroot ? 'Управляющие' : 'Менеджеры' }}</span>
                        </a>
                    </li>
                @endif

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.customers') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.customers.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Покупатели</span>
                        </a>
                    </li>
                @endif

                <li{!! stristr(Route::currentRouteName(), 'admin.dishes') ? ' class="active"': '' !!}>
                    <a href="{{ route('admin.dishes.index') }}">
                        <i class="fas fa-concierge-bell"></i>
                        <span>Блюда</span>
                    </a>
                </li>

                <li{!! stristr(Route::currentRouteName(), 'admin.categories') ? ' class="active"': '' !!}>
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-folder-open"></i>
                        <span>Категории блюд</span>
                    </a>
                </li>

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.markers') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.markers.index') }}">
                            <i class="fas fa-bookmark"></i>
                            <span>Маркеры блюд</span>
                        </a>
                    </li>
                @endif

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.kitchens') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.kitchens.index') }}">
                            <i class="fas fa-cookie-bite"></i>
                            <span>Кухни</span>
                        </a>
                    </li>
                @endif

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.specials') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.specials.index') }}">
                            <i class="fas fa-fire"></i>
                            <span>Акции</span>
                        </a>
                    </li>
                @endif

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.slides') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.slides.index') }}">
                            <i class="fas fa-images"></i>
                            <span>Слайды для главной</span>
                        </a>
                    </li>
                @endif

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.articles') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.articles.index') }}">
                            <i class="fas fa-newspaper"></i>
                            <span>Статьи</span>
                        </a>
                    </li>
                @endif

                @if($is_megaroot)
                    <li{!! stristr(Route::currentRouteName(), 'admin.helpmsgs') ? ' class="active"': '' !!}>
                        <a href="{{ route('admin.helpmsgs.index') }}">
                            <i class="far fa-edit"></i>
                            <span>Области</span>
                        </a>
                    </li>
                @endif


                {{--<li class="has-sub">--}}
                    {{--<a href="javascript:;">--}}
                        {{--<b class="caret"></b>--}}
                        {{--<i class="fa fa-align-left"></i>--}}
                        {{--<span>Menu Level</span>--}}
                    {{--</a>--}}
                    {{--<ul class="sub-menu">--}}
                        {{--<li class="has-sub">--}}
                            {{--<a href="javascript:;">--}}
                                {{--<b class="caret"></b>--}}
                                {{--Menu 1.1--}}
                            {{--</a>--}}
                            {{--<ul class="sub-menu">--}}
                                {{--<li class="has-sub">--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<b class="caret"></b>--}}
                                        {{--Menu 2.1--}}
                                    {{--</a>--}}
                                    {{--<ul class="sub-menu">--}}
                                        {{--<li><a href="javascript:;">Menu 3.1</a></li>--}}
                                        {{--<li><a href="javascript:;">Menu 3.2</a></li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li><a href="javascript:;">Menu 2.2</a></li>--}}
                                {{--<li><a href="javascript:;">Menu 2.3</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li><a href="javascript:;">Menu 1.2</a></li>--}}
                        {{--<li><a href="javascript:;">Menu 1.3</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->

    <!-- begin #content -->
    <div id="content" class="content clearfix">
        {{ @Breadcrumbs::render() }}

        <!-- begin page-header -->
        <h1 class="page-header">{{ $title }}
            @if($longtitle)
                &nbsp;<small>{{ $longtitle }}</small>
            @endif
        </h1>
        <!-- end page-header -->

        @if(session('success'))
            <div class="alert alert-green fade show m-b-10">
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

        @yield('content')
    </div>
    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/plugins/jquery/jquery-3.3.1.min.js"></script>
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<!--[if lt IE 9]>
<script src="/assets/crossbrowserjs/html5shiv.js"></script>
<script src="/assets/crossbrowserjs/respond.min.js"></script>
<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/plugins/js-cookie/js.cookie.js"></script>
<script src="/assets/js/theme/default.min.js"></script>
<script src="/assets/js/apps.min.js"></script>
<!-- ================== END BASE JS ================== -->

<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="/assets/plugins/highlight/highlight.common.js"></script>
<script src="/assets/js/demo/render.highlight.js"></script>
<script src="/assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
<script src="/assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/plugins/select2/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        App.init();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '[data-click="swal-warning"]', function (e) {
            var title = $(this).data('title') ? $(this).data('title') : 'Подтвердите действие',
                type = $(this).data('type') ? $(this).data('type') : 'warning',
                confirm_btn = $(this).data('actionbtn') ? $(this).data('actionbtn') : 'Ok',
                class_btn = $(this).data('classbtn') ? $(this).data('classbtn') : 'green',
                url = $(this).attr('href'),
                aftersuccess = $(this).data('aftersuccess'),
                options = {};


            e.preventDefault();
            options = {
                title: title,
                icon: type,
                buttons: {
                    cancel: {
                        text: 'Отмена',
                        value: !0,
                        visible: !0,
                        className: "btn btn-default", closeModal: !0,
                        value: "cancel"
                    },
                    confirm: {
                        text: confirm_btn,
                        value: !0,
                        visible: !0,
                        className: "btn btn-" + class_btn, closeModal: !0,
                        value: "confirm"
                    }
                }
            };

            if($(this).data('text')){
                options.text = $(this).data('text');
            }

            swal(options).then((value) => {
                switch (value) {
                    case "confirm":

                        if(!$(this).data('rm-order')){
                            window.location = url;
                        }else{
                            var link = $(this);
                            $.ajax({
                                type: "GET",
                                url: link.attr('href'),
                                dataType:"json",
                                error: function(xhr) {
                                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                                },
                                success: function(json) {
                                    if(json.success){
                                        if(typeof window[aftersuccess] === "function"){
                                            window[aftersuccess]();
                                        }
                                        $('#order_pos_'+link.data('rm-order')).remove();
                                    }
                                }
                            });
                        }

                        break;
                }
            });
        });

        if($('.default-select2').length){
            $(".default-select2").each(function(){
                var select = $(this),
                    search = select.data('search') ? true : - 1;

                select.select2({
                    minimumResultsForSearch: search,
                    placeholder: function(){
                        $(this).data('placeholder');
                    }
                });
            });
        }



    });

    function rus_to_latin(str) {
        var ru = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
            'е': 'e', 'ё': 'e', 'ж': 'j', 'з': 'z', 'и': 'i',
            'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
            'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u',
            'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch', 'ш': 'sh',
            'щ': 'shch', 'ы': 'y', 'э': 'e', 'ю': 'u', 'я': 'ya'
        }, n_str = [];

        str = str.replace(/[ъь]+/g, '').replace(/й/g, 'i').replace(' ', '-');

        for ( var i = 0; i < str.length; ++i ) {
            n_str.push(
                ru[ str[i] ]
                || ru[ str[i].toLowerCase() ] == undefined && str[i]
                || ru[ str[i].toLowerCase() ].replace(/^(.)/, function ( match ) { return match.toUpperCase() })
            );
        }

        return n_str.join('').toLowerCase();
    }
</script>

@stack('js')
@stack('modals')
</body>
</html>
