<div class="shop_pos_item p-2" data-product-id="{{ $dish->id }}">

    <div class="image mb-1">
        @if($dish->markers)
            <div class="badges d-flex align-items-start flex-column">
                @foreach($dish->markers as $marker)
                    <div class="{!! $marker->css_class !!}">{!! $marker->content !!}</div>
                @endforeach
            </div>
        @endif
        @if(Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_m.jpg'))
            <img src="{{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_m.jpg') }}" alt="">
        @endif
    </div>

    <div class="title font-weight-bold">
        {{ $dish->name }}
    </div>
    <div class="params text-secondary">
        {{ $dish->short_description }}
    </div>
    <div class="price d-flex justify-content-between">
        <div class="h4 mb-0">
            @if($dish->new_price)
                {{--<span class="old">{{ $dish->price }} &#8381;</span>--}}
                <span class="new">{{ $dish->new_price }} &#8381;</span>
            @else
                {{ $dish->price }} &#8381;
            @endif
        </div>
        <div>
            <button class="btn btn-success btn-sm add_to_cart" data-dish-id="{{ $dish->id }}">В корзину</button>
        </div>
    </div>
</div>
@push('modals')
    <div class="modal fade product" id="shop_pos_item_modal_{{ $dish->id }}" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_{{ $dish->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>

                <div class="modal-body">

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
                                        {{--<span class="old">{{ $dish->price }} &#8381;</span>--}}
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
                                            <div class="item d-flex align-items-center{{ $loop->index ? ' border-top mt-2 pt-2' : ' mt-2' }}">

                                                @if(Storage::disk('public')->exists('dish_imgs/'.$recomended->id.'/img_s.jpg'))
                                                    <div class="image">
                                                        <img src="{{ Storage::disk('public')->url('dish_imgs/'.$recomended->id.'/img_s.jpg') }}" alt="">
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
                                                        <span class="new">{{ $recomended->new_price }} &#8381;</span>
                                                    @else
                                                        {{ $recomended->price }} &#8381;
                                                    @endif
                                                </div>
                                                <div>
                                                    <button class="btn btn-success btn-sm word text-nowrap add_to_cart" data-dish-id="{{ $dish->id }}">В корзину</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="past d-none mt-2 pt-1">
                                <div class="h4 text-uppercase font-weight-light mb-0">Просмотренные</div>
                                <div class="items">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush