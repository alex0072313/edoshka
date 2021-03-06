@extends('layouts.site', ['body_class'=>'restaurant_page'])
@section('content')
	<section id="greetin_page_default" class="shop" {!! Storage::disk('public')->exists('restaurant_imgs/'.$restaurant->id.'/src.jpg') ? ' style="background-image: url(\''.Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/src.jpg').'\');"' : '' !!}>
		<div class="container position-relative h-100">
			<div class="d-flex align-content-end flex-wrap inner">
				<nav aria-label="breadcrumb" class="d-inline-block mx-auto mx-md-0">
					{{ @Breadcrumbs::render() }}
				</nav>
				<div class="d-md-flex w-100 text-md-left text-center">
					<div class="clearfix flex-grow-1">
						<h1 class="h1 font-weight-bolder text-white float-md-left shop_title mb-2">
							@php
								$var = 'restaurant_'.$restaurant->id.'_title';
							@endphp
							@helpmsg($var)
						</h1>
					</div>
					<div class="mr-4">
                        <div class="dropdown">
                            <button class="btn btn-outline-light btn-sm d-inline-block d-sm-none my-2" data-toggle="modal" data-target="#shop_about_modal">
                                <i class="fas fa-info-circle mr-1"></i> О ресторане
                            </button>

                            <button class="btn btn-outline-light btn-sm text-left shop_info_btn d-none d-sm-inline-block" data-toggle="modal" data-target="#shop_about_modal">
                                <div class="d-flex">
                                    <div class="mr-2"><i class="fas fa-info-circle"></i></div>
                                    <div class="font-weight-light">
                                        @php
                                        $var = 'restaurant_info_btn';
                                        @endphp
                                        @helpmsg($var)
                                    </div>
                                </div>
                            </button>
                        </div>

                        @push('modals')
                            <div class="modal product" id="shop_about_modal" tabindex="-1" role="dialog" aria-labelledby="shop_about_title" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                        </button>
                                        <div class="modal-body">
                                            <div class="h2 mb-4" id="card__module_modal_title">Информация о ресторане</div>

                                            {!! $restaurant->description !!}

                                            @if($restaurant->address)
                                                <div>
                                                    Адрес: {{ $restaurant->address }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endpush

					</div>
				</div>

				@if($restaurant->min_free_delivery || $restaurant->worktime)
					<div class="mb-3 mt-3 mb-md-5 w-100 text-white font-weight-light shop_min_price text-md-left text-center ml-n3">
                        @if($restaurant->min_free_delivery)
                            <span  class="ml-3 d-sm-inline-block d-block">
                                <i class="fas fa-shipping-fast mr-1"></i> Бесплатная доставка от {{ $restaurant->min_free_delivery }} &#8381;
                            </span>
                        @endif
                        @if($restaurant->worktime && isset($restaurant->worktime[0]) && isset($restaurant->worktime[1]))
                            <span class="ml-3 d-sm-inline-block d-block">
                                <i class="fas fa-clock mr-1"></i> Работаем с  {{ $restaurant->worktime[0] }} до {{ $restaurant->worktime[1] }}
                            </span>
                        @endif
					</div>
				@endif
				{{--<div class="w-100 shop_last_review py-4">--}}
					{{--<a href="#" class="d-block text-white">--}}
						{{--<i class="fas fa-comments fa-sm mr-2"></i>--}}
						{{--Лучшее что я когда либо пробовал...--}}
					{{--</a>--}}
				{{--</div>--}}
			</div>
		</div>
	</section>
	<section id="products" class="mb-5">
		<div class="filter_mobile d-md-none d-block">
			<div class="container">
				<div class="inner d-flex">
                    <a href="javascript:;" class="open"><i class="fas fa-angle-down"></i></a>
                    <a href="javascript:;" class="close"><i class="fas fa-times"></i></a>
					<div class="flex-grow-1">
                        <div class="flex-column">
                            <div class="nav_outer custom_scrollbar">
                                <ul class="products_nav products_nav_mobile">

                                    @if($specials->count())
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#products_group_specials">Акции</a>
                                        </li>
                                    @endif

                                    @if($dishes_pop->count())
                                        <li class="nav-item">
                                            <a class="nav-link{{ !$specials->count() ? ' active' : '' }}" href="#products_group_pop">Популярное</a>
                                        </li>
                                    @endif

                                    @foreach($categories as $category)
                                        <li class="nav-item">
                                            <a class="nav-link{{ $loop->first && (!$specials->count() && !$dishes_pop->count()) ? ' active' : '' }}" href="#products_group_{{ $category->id }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
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

                        <div class="nav_outer custom_scrollbar">
                            <ul class="nav flex-column mt-3 products_nav products_nav_desctop">

                                @if($specials->count())
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#products_group_specials">Акции</a>
                                    </li>
                                @endif

                                @if($dishes_pop->count())
                                    <li class="nav-item">
                                        <a class="nav-link{{ !$specials->count() ? ' active' : '' }}" href="#products_group_pop">Популярное</a>
                                    </li>
                                @endif

                                @foreach($categories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link{{ $loop->first && (!$specials->count() && !$dishes_pop->count()) ? ' active' : '' }}" href="#products_group_{{ $category->id }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

					</div>
				</div>
				<div class="col-md-9">

                        @if($specials->count())
                            <div id="products_group_specials">
                                <h2 class="h2 mb-3 text-md-left text-center products_title">Акции ресторана {{ $restaurant->name }}</h2>
                                <div class="shop_slider">
                                    <div class="specials_slider" id="specials_slider">
                                        @foreach($specials as $special)
                                            <div class="inner px-2">
                                                <div class="card text-white">
                                                    <div class="inner"{!! Storage::disk('public')->exists('special_imgs/'.$special->id.'/src.jpg') ? ' style="background-image: url(\''.Storage::disk('public')->url('special_imgs/'.$special->id.'/src.jpg').'\');"' : '' !!}>
                                                        <div class="card-img-overlay">
                                                            <div>
                                                                <div class="h4">
                                                                    {{ $special->name }}
                                                                </div>
                                                                <p class="mb-0 font-weight-light">{{ $special->content }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($dishes_pop->count())
                            <div class="products_group{{ $specials->count() ? ' mt-4' : '' }}" id="products_group_pop">
                                <h2 class="h2 mb-3 products_title text-md-left text-center ">Популярно в ресторане {{ $restaurant->name }}</h2>
                                <div class="products_items">
                                    <div class="row mr-0">
                                        @foreach($dishes_pop as $dish)
                                            <div class="col-6 col-sm-4 col-md-4 col-lg-3 px-0 pl-3 mb-3">
                                                @include('site.includes.dish', ['cart'=>true])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

						@foreach($categories as $category)
							<div class="products_group{{ !$loop->first || $specials->count() ? ' mt-4' : '' }}" id="products_group_{{ $category->id }}">
							    <h2 class="h2 mb-3 products_title text-md-left text-center">{{ $category->name }}</h2>
								<div class="products_items">
									<div class="row mr-0">
										@foreach($category->dishes as $dish)
											<div class="col-6 col-sm-4 col-md-4 col-lg-3 px-0 pl-3 mb-3">
												@include('site.includes.dish', ['cart'=>true])
											</div>
										@endforeach
									</div>
								</div>
							</div>
						@endforeach
					</div>
            </div>

            @php
                $var = 'town_'.$_town->id.'_restaurant_'.$restaurant->id.'_content';
            @endphp
            @helpmsg($var)

            @php
                $var = 'town_'.$_town->id.'_balls_info';
            @endphp
            @helpmsg($var)

			</div>
		</div>
	</section>
@endsection

@push('js')
    <script>
        var url_params = queryString.parse(location.hash);
        if(url_params.d) load_dish_modal(url_params.d);
        $(document).ready(function () {
            if(url_params.d) scrollToElement($('#dish'+url_params.d), 700, 15);
        });
    </script>
@endpush
