<div class="card__module">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="svg_image"></div>
                <a href="javascript:;" class="order_modal_show">
                    <div class="h4 text-white ml-2 font-weight-light text-uppercase mb-0 d-md-block d-none">
                        Корзина
                    </div>

                </a>
                <div class="h4 text-white ml-3 font-weight-light  mb-0 d-md-none d-block">
                    <span class="sum">{{ $_cart_total_p }}</span> ₽
                </div>
            </div>
            <div class="h4 text-white ml-2 font-weight-light mb-0 d-md-block d-none">
                Выбрано: <span class="quantity">{{ $_cart_total_q }}</span>
            </div>
            <div class="h4 text-white ml-2  mb-0 d-md-block d-none">
                Сумма: <span class="sum">{{ $_cart_total_p }}</span> ₽
            </div>
            <div class="">
                <button class="btn btn-light order_modal_show">Оформить заказ</button>
            </div>
        </div>
    </div>
</div>

<div class="modal product" id="card__module_modal" tabindex="-1" role="dialog" aria-labelledby="card__module_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal_order" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">
                <div class="h2 mb-4" id="card__module_modal_title">Оформление заказа</div>

                <div class="order_form" data-action="{{ route('site.send_order') }}">
                    <div class="card_products mb-4">
                        <div class="h4 text-uppercase font-weight-light mb-3 text-black">Ваш заказ</div>

                        <table class="table items table-sm">
                            @if(count($_cart_content))
                                @foreach($_cart_content as $item)
                                    <tr class="item">
                                        <td>
                                            @if(Storage::disk('public')->exists('dish_imgs/'.$item->id.'/img_xs.jpg'))
                                                <div class="image">
                                                    <img src="{{ Storage::disk('public')->url('dish_imgs/'.$item->id.'/img_xs.jpg') }}" alt="">
                                                </div>
                                            @endif
                                        </td>
                                        <td class="font-weight-bold">
                                            {{ $item->name }}
                                            @if($item->attributes->has('short_description'))
                                                <span class="ml-2 text-secondary font-weight-normal">{{ $item->attributes['short_description'] }}</span>
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
                                            </div>
                                        </td>
                                        <td class="remove">
                                            <a href="javascript:;" class="remove_from_cart" data-dish-id="{{ $item->id }}"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <div class="h4 text-secondary font-weight-light mb-0">Сумма заказа</div>
                                    </td>
                                    <td class="text-nowrap text-center">
                                        <div class="h4 mb-0">
                                            {{ $_cart_total_p }} ₽
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            @else
                                <tr class="item"><td colspan="5">Нет блюд в корзине!</td></tr>
                            @endif

                        </table>
                    </div>

                    <div class="card_order_info mb-4">
                        <div class="h4 text-uppercase font-weight-light mb-3 text-black">Данные для оформления</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Телефон <b class="text-danger">*</b></label>
                                    <input type="text" name="phone" class="form-control phone_input" id="phone" aria-describedby="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guest">Кол-во приборов</label>

                                    <div class="input-group count_input">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-sm quintity_cart_m" type="button"><i class="fas fa-minus fa-sm"></i></button>
                                        </div>
                                        <input type="number" name="persons" min="1" readonly value="1" class="bg-white form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm quintity_cart_p" type="button"><i class="fas fa-plus fa-sm"></i></button>
                                        </div>
                                    </div>

                                    {{--<input type="number" name="persons" class="form-control" id="guest" aria-describedby="guest">--}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="street">Улица</label>
                                    <input type="text" name="street" class="form-control" id="street" aria-describedby="street">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" aria-describedby="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="home">Дом</label>
                                    <input type="text" name="home" class="form-control" id="home" aria-describedby="home">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dop">Пожелания</label>
                            <textarea name="dop" class="form-control" id="dop" aria-describedby="dop" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="card_order_info mb-5">
                        <div class="h4 text-uppercase font-weight-light mb-3 text-black">Оплата</div>
                        <div class="form-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" value="1" id="pay_1" name="customRadio" class="custom-control-input" checked>
                                <label class="custom-control-label" for="pay">При получении</label>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success btn-lg submit" onclick="ym(53176072, 'reachGoal', 'order');">Отправить заказ</button>
                </div>

            </div>

        </div>
    </div>
</div>
