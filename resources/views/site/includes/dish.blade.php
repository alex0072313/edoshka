<div class="shop_pos_item p-2" data-product-id="{{ $dish->id }}">
    <div class="image mb-1">
        <div class="badges">
            <div class="new">NEW</div>
            <div class="top">TOP</div>
        </div>
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
        <div class="h4 mb-0">{{ $dish->price }} &#8381;</div>
        <div>
            <button class="btn btn-success btn-sm add_to_cart" data-product-id="{{ $dish->id }}">В корзину</button>
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
                                @if(Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_l.jpg'))
                                    <img src="{{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_l.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="h2" id="shop_pos_item_title_{{ $dish->id }}">
                                {{ $dish->name }}
                                @if($dish->short_description)
                                    <span class="badge text-success bg-transparent">{{ $dish->short_description }}</span>
                                @endif
                            </div>
                            @if($dish->description)
                                <div class="text-secondary mb-3">
                                    {{ $dish->description }}
                                </div>
                            @endif
                            <div class="price d-flex justify-content-between">
                                <div class="h1 mb-0">{{ $dish->price }} ₽</div>
                                <div>
                                    <button class="btn btn-success btn-lg">В корзину</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 border-left dops mt-3 mt-lg-0">
                            <div class="past">
                                <div class="h4 text-uppercase font-weight-light">Просмотренные</div>
                                <div class="items">
                                    <div class="item d-flex align-items-center">
                                        <div class="image">
                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="flex-grow-1 ml-2 font-weight-bold">
                                            Роллы "Вулкан" Роллы "Вулкан"
                                            <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                        </div>
                                        <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                        <div>
                                            <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                        </div>
                                    </div>
                                    <div class="item d-flex align-items-center border-top">
                                        <div class="image">
                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="flex-grow-1 ml-2 font-weight-bold">
                                            Роллы "Вулкан"
                                            <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                        </div>
                                        <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                        <div>
                                            <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="recomend mt-2 pt-1">
                                <div class="h4 text-uppercase font-weight-light">Рекомендуем</div>
                                <div class="items">
                                    <div class="item d-flex align-items-center">
                                        <div class="image">
                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="flex-grow-1 ml-2 font-weight-bold">
                                            Роллы "Вулкан"
                                            <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                        </div>
                                        <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                        <div>
                                            <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                        </div>
                                    </div>
                                    <div class="item d-flex align-items-center border-top">
                                        <div class="image">
                                            <img src="/images/theme/roll1.jpg" alt="">
                                        </div>
                                        <div class="flex-grow-1 ml-2 font-weight-bold">
                                            Роллы "Вулкан"
                                            <span class="ml-2 text-secondary font-weight-normal">
                                            270/8 шт
                                        </span>
                                        </div>
                                        <div class="h4 mb-0 mr-2 text-nowrap">99 ₽</div>
                                        <div>
                                            <button class="btn btn-success btn-sm word text-nowrap">В корзину</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush