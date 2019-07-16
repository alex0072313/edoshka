@php
    $restaurants = [];

    if(count($_cart_content)){
    
        $dishes = $_cart_content
        ->sortBy(function ($dish) {
            return $dish->attributes['restaurant_id'];
        })
        ->map(function ($dish){
            $dish->restaurant = $dish->attributes['restaurant'];
            return $dish;
        });

        foreach ($dishes as $dish){
            $restaurants[$dish->restaurant->id]['name'] = $dish->restaurant->name;
            $restaurants[$dish->restaurant->id]['alias'] = $dish->restaurant->alias;
            $restaurants[$dish->restaurant->id]['specilals'] = $dish->restaurant->specilals;
            $restaurants[$dish->restaurant->id]['sum_price'] =+ $dish->price;
            $restaurants[$dish->restaurant->id]['dishes'][] = $dish;
        }
    }
@endphp

@if(count($restaurants))

    @foreach($restaurants as $restaurant_id => $restaurant_data)
        <tr class="item border-top-0">
            <td colspan="5" class="p-0 border-top-0">

                <div class="d-flex justify-content-between">
                    <div>
                        <small>Заказы в ресторане {{ $restaurant_data['name'] }}
                        @if (App\Restaurant::find($restaurant_id)->specials()->count())
                            <a href="{{ route('site.restaurant', $restaurant_data['alias']) }}#products_group_specials" class="ml-2">Есть акции</a>
                        @endif
                        </small>
                    </div>
                    @if(isset($_cart_restaurants_small_order[$restaurant_id]))
                        <div class="mb-2">
                            <small class="text-danger mr-3">Не хватает до мин. суммы заказа - {{ $_cart_restaurants_small_order[$restaurant_id] - $restaurant_data['sum_price'] }} ₽</small>
                            <a href="{{ route('site.restaurant', ['restaurant_alias' => $restaurant_data['alias']]) }}" class="btn btn-primary btn-sm">добавить еще</a>
                        </div>
                    @endif
                </div>

            </td>
        </tr>
        @foreach($restaurant_data['dishes'] as $item)
            <tr class="item">
                <td>
                    @if(Storage::disk('public')->exists('dish_imgs/'.$item->id.'/img_xs.jpg'))
                        <div class="image">
                            <img src="{{ Storage::disk('public')->url('dish_imgs/'.$item->id.'/img_xs.jpg') }}" alt="">
                        </div>
                    @endif
                </td>
                <td class="">
                    <div class="font-weight-bold">{{ $item->name }}</div>
                    @php
                        $variant_str = '';
                        if($variants = $item->attributes['variants']){
                            $i = 0;
                            foreach($variants as $k => $v){
                                $variant_str .= ($i ? ', ' : '').trim($k).': '.trim($v);
                                $i++;
                            }
                        }
                    @endphp
                    @if($variant_str)
                        <small class="text-secondary font-weight-normal">{{ $variant_str }}</small>
                        <input type="hidden" name="dishes_variants[{{ $item->id }}]" value="{{ $variant_str }}">
                    @elseif($item->attributes['short_description'])
                        <small class="text-secondary font-weight-normal">{{ $item->attributes['short_description'] }}</small>
                        <input type="hidden" name="dishes_variants[{{ $item->id }}]" value="{{ $item->attributes['short_description'] }}">
                    @elseif($item->attributes['weight'])
                        <small class="text-secondary font-weight-normal">{{ $item->attributes['weight'] }}г</small>
                        <input type="hidden" name="dishes_variants[{{ $item->id }}]" value="{{ $item->attributes['weight'] }}г">
                    @endif
                </td>
                <td class="count">
                    <div class="input-group count_input w-50">
                        <div class="input-group-prepend">
                            <button class="btn btn-sm quintity_cart_m" type="button"><i class="fas fa-minus fa-sm"></i></button>
                        </div>
                        <input type="number" name="dishes[{{ $item->id }}]" min="0" readonly value="{{ $item->quantity }}" data-dish-id="{{ $item->id }}" class="bg-white form-control form-control-sm quintity_cart">
                        <div class="input-group-append">
                            <button class="btn btn-sm quintity_cart_p" type="button"><i class="fas fa-plus fa-sm"></i></button>
                        </div>
                    </div>
                </td>
                <td class="text-nowrap text-center">
                    <div class="h4 mb-0">
                        {{ $item->price }} ₽

                        <input type="hidden" name="dishes_prices[{{ $item->id }}]" value="{{ $item->price }}">
                    </div>
                </td>
                <td class="remove">
                    <a href="javascript:;" class="remove_from_cart" data-dish-id="{{ $item->id }}"><i class="fas fa-times"></i></a>
                </td>
            </tr>
        @endforeach
    @endforeach

    @if(count($restaurants) > 1)
        <tr>
            <td colspan="5">
                <div class="alert alert-primary fade show mb-0">
                    <div class="h5">Внимание! Вы заказываете в {{ count($restaurants) }} разных ресторанах, ознакомьтесь с условиями.</div>

                    <ul class="pl-3 mt-3">
                        <li>Для подтверждения заказа - с Вами свяжутся операторы из каждого ресторана</li>
                        <li>Доставка будет осуществляться {{ count($restaurants) }} разными курьерами</li>
                        <li>Время ожидания заказа может быть разное</li>
                        <li>Акции одного ресторана НЕ распространяются на заказы из другого ресторана</li>
                    </ul>

                    <div class="custom-control custom-checkbox mt-1">
                        <input type="checkbox" name="accept_usl" value="1" class="custom-control-input" id="accept_usl">
                        <label class="custom-control-label font-weight-bold" style="color: inherit !important;" for="accept_usl">Я ознакомился(ась) с условиями заказа и подтверждаю свое согласие</label>
                    </div>
                </div>
            </td>
        </tr>
    @endif

    <tr>
        <td colspan="3">
            <div class="d-flex">
                @if($_cart_restaurants_small_order)
                    <div class="text-danger"><small>Внимание! Сумма Вашего заказа в некоторых ресторанах не удовлетворяет минимальной.<br>Для оформления заказа добавьте еще что-нибудь из этого ресторана.</small></div>
                @endif
                <div class="h4 text-secondary font-weight-light mb-0 flex-grow-1 text-nowrap text-right">Сумма заказа</div>
            </div>


        </td>
        <td class="text-nowrap text-center">
            <div class="h4 mb-0">
                {{ $_cart_total_p }} ₽
            </div>
        </td>
        <td></td>
    </tr>
    @if(!$_cart_restaurants_small_order)
        <tr>
            <td colspan="3">
                <div class="h4 text-primary mb-0 text-nowrap text-right">Начислится баллов</div>
            </td>
            <td class="text-nowrap text-center">
                <div class="h4 mb-0 text-primary">
                    {{ calc_balls($_cart_total_p) }}
                </div>
            </td>
            <td></td>
        </tr>
    @endif
@else
    <tr class="item"><td colspan="5">Нет блюд в корзине!</td></tr>
@endif
