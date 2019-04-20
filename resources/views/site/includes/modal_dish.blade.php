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
            <span class="badge text-success bg-transparent pl-0"><span id="dish_{{$dish->id}}_variants_shortname_holder">{{ $dish->short_description ? $dish->short_description : $dish->weight ? $dish->weight.'г' : '' }}</span></span>
        </div>

        @if($dish->description)
            <div class="text-secondary mb-3">
                {{ $dish->description }}
            </div>
        @endif

        @if($dish->variants->count())
            <div id="dish_{{$dish->id}}_variants" class="dish_variants_groups" data-id="{{$dish->id}}" data-price="{{ $dish->new_price ? $dish->new_price : $dish->price }}" data-weight="{{ $dish->weight }}">
                @foreach($dish->variants as $group)
                    <div class="dish_variants_group" data-id="{{$group->id}}" data-name="{{ $group->name }}">
                        <div class="h6">{{ $group->name }} <span class="text-danger">*</span> </div>
                        <div class="btn-group-toggle" data-toggle="buttons">
                            @if(count($group->variants))
                                @foreach($group->variants as $group_variant)
                                    @php
                                        $all_name = explode('|', $group_variant['name']);
                                        $name = $all_name[0];
                                        $short_name = isset($all_name[1]) ? $all_name[1] : '';
                                    @endphp
                                    <button class="btn btn-outline-primary btn-sm mr-1 mb-2">
                                        <input type="radio"
                                               name="dish_{{$dish->id}}_variants_group_{{$group->id}}"
                                               id="dish_{{$dish->id}}_variants_group_{{$group->id}}_{{$loop->index}}"
                                               data-name="{{ $name }}"
                                               data-shortname="{{ $short_name }}"
                                               data-price="{{ $group_variant['price'] }}"
                                               data-weight="{{ $group_variant['weight'] }}"
                                               autocomplete="off"> {{ $name }}
                                    </button>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        @endif

        <div class="price d-flex justify-content-between">
            <div class="h1 mb-0">
                @if($dish->new_price)
                    <small class="old">{{ $dish->price }}</small>
                    <span class="new"><span id="dish_{{$dish->id}}_variants_price_holder">{{ $dish->new_price }}</span> &#8381;</span>
                @else
                    <span id="dish_{{$dish->id}}_variants_price_holder">{{ $dish->price }}</span> &#8381;
                @endif
            </div>
            <div>
                <button class="btn btn-success btn-lg modal_add_to_cart" data-dish-id="{{ $dish->id }}" data-price="{{ $dish->price }}" data-weight="" data-variants="">В корзину</button>
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
                                    <img
                                        src="{{ Storage::disk('public')->url('dish_imgs/'.$recomended->id.'/img_s.jpg') }}"
                                        alt="">
                                </div>
                            @endif

                            <div class="flex-grow-1 ml-2 font-weight-bold">
                                {{ $recomended->name }}
                                <div class="text-secondary font-weight-normal">
                                    {{ $recomended->short_description }}
                                </div>
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
                        <div class="item d-flex align-items-center{{ $loop->index ? ' border-top mt-2 pt-2' : ' mt-2' }}">
                            @if(Storage::disk('public')->exists('dish_imgs/' . $viewed->id . '/img_xs.jpg'))
                                <div class="image">
                                    <img src="{{ Storage::disk('public')->url('dish_imgs/' . $viewed->id . '/img_xs.jpg') }}" alt="{{ $viewed->name }}">
                                </div>
                            @endif
                            <div class="flex-grow-1 ml-2 font-weight-bold">
                                {{ $viewed->name }}
                                <div class="text-secondary font-weight-normal">{{ $viewed->short_description }}</div></div>
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
