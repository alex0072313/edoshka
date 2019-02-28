<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
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
            <a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> <b>Color</b> Admin</a>
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
                        <div class="cover with-shadow"{!! Storage::disk('public')->exists('restaurant_imgs/'.$restaurant->id.'/thumb_m.jpg') ? ' style="background-image:url('.Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/thumb_m.jpg').');"' : ''!!}></div>

                        @if(Storage::disk('public')->exists('user_imgs/'.$user->id.'/thumb_s.jpg'))
                            <div class="image image-icon">
                                <img src="{{ Storage::disk('public')->url('user_imgs/'.$user->id.'/thumb_s.jpg') }}" alt="">
                            </div>
                        @else
                            <div class="image image-icon bg-black text-grey-darker">
                                <i class="material-icons">person</i>
                            </div>
                        @endif

                        <div class="info">
                            <b class="caret pull-right"></b>
                            {{ $restaurant->name }}
                            <small>{!! ($user->lastname ? $user->lastname.'&nbsp' : '') . $user->name !!} ({{ config('role.names.'.$user->roles()->get()->first()->name.'.dolg') }})</small>
                        </div>
                    </a>
                </li>
                <li>
                    <ul class="nav nav-profile">
                        <li><a href="{{ route('admin.profile') }}"><i class="fa fa-cog"></i> Профиль пользователя</a></li>
                        <li><a href="{{ route('admin.restaurant') }}"><i class="fas fa-map-marked-alt"></i> Данные ресторана</a></li>
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
    <div id="content" class="content">
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

        $('[data-click="swal-warning"]').click(function (e) {
            var title = $(this).data('title') ? $(this).data('title') : 'Подтвердите действие',
                type = $(this).data('type') ? $(this).data('type') : 'warning',
                confirm_btn = $(this).data('actionbtn') ? $(this).data('actionbtn') : 'Ok',
                class_btn = $(this).data('classbtn') ? $(this).data('classbtn') : 'green',
                url = $(this).attr('href'),
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
                        window.location = url;
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
</script>
</body>
</html>
