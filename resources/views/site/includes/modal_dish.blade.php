<div class="row">
    <div class="col-lg-6">
        <div class="image mb-3">
            @if($dish->markers)
                <div class="badges d-flex align-items-start flex-column">
                    @foreach($dish->markers as $marker)
                        <div class="{{ $marker->css_class }}">{!! $marker->content !!}</div>
                    @endforeach
                </div>
            @endif
            @if(Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_l.jpg'))
                <img src="{{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_l.jpg') }}" alt="">
            @endif
        </div>
        <div class="h2" id="shop_pos_item_title_{{ $dish->id }}">
            <span class="pr-2">{{ $dish->name }}</span>
            @if($dish->short_description)
                <span class="badge text-success bg-transparent pl-0">{{ $dish->short_description }}</span>
            @endif
        </div>
        @if($dish->description)
            <div class="text-secondary mb-3">
                {{ $dish->description }}
            </div>
        @endif
        <div class="price d-flex justify-content-between">
            <div class="h1 mb-0">
                @if($dish->new_price)
                    <small class="old">{{ $dish->price }}</small>
                    <span class="new">{{ $dish->new_price }} &#8381;</span>
                @else
                    {{ $dish->price }} &#8381;
                @endif
            </div>
            <div>
                <button class="btn btn-success btn-lg add_to_cart" data-dish-id="{{ $dish->id }}">В корзину</button>
            </div>
        </div>
    </div>
    <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
        @if($dish->recomendeds->count())
            <div class="recomend">
                <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                <div class="items">
                    @foreach($dish->recomendeds as $recomended)
                        <div
                            class="item d-flex align-items-center{{ $loop->index ? ' border-top mt-2 pt-2' : ' mt-2' }}">

                            @if(Storage::disk('public')->exists('dish_imgs/'.$recomended->id.'/img_s.jpg'))
                                <div class="image">
                                    <img
                                        src="{{ Storage::disk('public')->url('dish_imgs/'.$recomended->id.'/img_s.jpg') }}"
                                        alt="">
                                </div>
                            @endif

                            <div class="flex-grow-1 ml-2 font-weight-bold">
                                {{ $recomended->name }}
                                <span class="ml-2 text-secondary font-weight-normal">
												{{ $recomended->short_description }}
											</span>
                            </div>
                            <div class="h4 mb-0 mr-2 text-nowrap price">
                                @if($recomended->new_price)
                                    <small class="old mr-1">{{ $recomended->price }}</small>
                                    <span class="new">{{ $recomended->new_price }} &#8381;</span>
                                @else
                                    {{ $recomended->price }} &#8381;
                                @endif
                            </div>
                            <div>
                                <button class="btn btn-success btn-sm word text-nowrap add_to_cart"
                                        data-dish-id="{{ $recomended->id }}">В корзину
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(count($dishes_viewed))
            <div class="past mt-2 pt-1">
                <div class="h4 text-uppercase font-weight-light mb-0">Просмотренные</div>

                <div class="items">
                    @foreach($dishes_viewed as $viewed)
                        <div class="item d-flex align-items-center mt-2">
                            @if(Storage::disk('public')->exists('dish_imgs/' . $viewed->id . '/img_xs.jpg'))
                                <div class="image">
                                    <img src="{{ Storage::disk('public')->url('dish_imgs/' . $viewed->id . '/img_xs.jpg') }}" alt="{{ $viewed->name }}">
                                </div>
                            @endif
                            <div class="flex-grow-1 ml-2 font-weight-bold">{{ $viewed->name }}<span class="ml-2 text-secondary font-weight-normal">{{ $viewed->short_description }}</span></div>
                            <div class="h4 mb-0 mr-2 text-nowrap price">
                                @if($viewed->new_price)
                                    <small class="old">{{ $viewed->price }}</small>
                                    <span class="new">{{ $viewed->new_price }} &#8381;</span>
                                @else
                                    {{ $viewed->price }} &#8381;
                                @endif
                            </div>
                            <div>
                                <button class="btn btn-success btn-sm word text-nowrap add_to_cart" data-dish-id="{{ $viewed->id }}">В корзину</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
