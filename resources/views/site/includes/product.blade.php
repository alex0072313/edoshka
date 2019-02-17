@php
    $id = rand ();
@endphp

<div class="shop_pos_item p-2" data-product-id="{{ $id }}">
        <div class="image">
            <div class="badges">
                <div class="new">NEW</div>
                <div class="top">TOP</div>
            </div>

            <img src="/images/theme/roll1.jpg" alt="">
        </div>
        <div class="title font-weight-bold">
            Роллы "Вулкан"
        </div>
        <div class="params text-secondary">
            270/8 шт
        </div>
        <div class="price d-flex justify-content-between">
            <div class="h4 mb-0">99 &#8381;</div>
            <div>
                <button class="btn btn-success btn-sm add_to_cart" data-product-id="{{ $id }}">В корзину</button>
            </div>
        </div>
</div>

@push('modals')
<div class="modal fade product" id="shop_pos_item_modal_{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="shop_pos_item_title_{{ $id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-3">
                            <img src="/images/theme/roll_big.jpg" alt="">
                        </div>
                        <div class="h2" id="shop_pos_item_title_{{ $id }}">
                            Роллы "Вулкан"
                            <span class="badge text-success bg-transparent">270/8 шт</span>
                        </div>
                        <div class="text-secondary mb-3">
                            Водоросли чука, сливочный сыр, авокадо, огурец, перец болгарский, икра масаго, соус 222 г
                        </div>
                        <div class="price d-flex justify-content-between">
                            <div class="h1 mb-0">99 ₽</div>
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
