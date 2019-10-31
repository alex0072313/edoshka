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
{{--                        <div class="h4 font-weight-light mb-3 text-black">Ваш заказ в ресторане {{ $_cart_restaurant_name }}</div>--}}

                        @if($_cart_restaurants_out_worktime)
                            <div class="alert alert-warning fade show mb-0">
                                У Вас есть заказы из ресторанов, время работы которых не соответствует текущему! Заказ будет возможен в их рабочее время.
                                <ul class="pl-3 mb-0">
                                    @foreach($_cart_restaurants_out_worktime as $restaurant)
                                        <li><strong>{{ $restaurant->name }}</strong> - {{ $restaurant->worktime[0] }} до {{ $restaurant->worktime[1] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="table items table-sm">
                            @include('site.includes.card_content')
                        </table>
                    </div>

                    <div class="card_order_actions{{ $_cart_restaurants_small_order ? ' disabled_box' : '' }}">

                        @if($comment_delivery = $restaurant->comment_delivery)
                            <div class="card_comment_delivery mb-4">
                                <div class="h4 text-uppercase font-weight-light mb-3 text-black">Информация о доставке</div>
                                <div class="text-secondary">{{ $comment_delivery }}</div>
                            </div>
                        @endif

                        <div class="card_order_info mb-4">
                            <div class="h4 text-uppercase font-weight-light mb-3 text-black">Данные для оформления</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Телефон <b class="text-danger">*</b></label>
                                        <input type="text" name="phone" value="{{ isset($_user) ? $_user->phone : '' }}" class="form-control" id="phone" aria-describedby="phone" placeholder="+79281234567">
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
                                        <input type="text" name="name" value="{{ isset($_user) ? $_user->name : '' }}" class="form-control" id="name" aria-describedby="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="street">Улица</label>
                                        <input type="text" name="street" value="{{ isset($_user) ? $_user->street : '' }}" class="form-control" id="street" aria-describedby="street">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" value="{{ isset($_user) ? $_user->email : '' }}" class="form-control" id="email" aria-describedby="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="home">Дом</label>
                                        <input type="text" name="home" value="{{ isset($_user) ? $_user->home : '' }}" class="form-control" id="home" aria-describedby="home">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dop">Пожелания</label>
                                <textarea name="dop" class="form-control" id="dop" aria-describedby="dop" rows="4"></textarea>
                            </div>
                        </div>

                        @if(!auth()->user())
                            <div class="card_register mb-4">
                                <div class="h4 text-uppercase font-weight-light mb-3 text-black">Регистрация на сайте</div>

                                <div class="row mx-0">
                                    <div class="col-lg-6">
                                        <div class="row">

                                            <div class="custom-control custom-radio col-6 mb-2">
                                                <input type="radio" value="phone" id="reg_on_phone" name="reg_type" class="custom-control-input" checked data-select-text="Вы будете зарегистрированы по номеру телефона %p">
                                                <label class="custom-control-label text-dark" for="reg_on_phone">Через телефон</label>
                                            </div>

                                            <div class="custom-control custom-radio col-6 mb-2">
                                                <input type="radio" value="email" id="reg_on_email" name="reg_type" class="custom-control-input" data-select-text="На Ваш email %e будет отправлено письмо с логином и паролем для входа на сайт">
                                                <label class="custom-control-label text-dark" for="reg_on_email">Через Email</label>
                                            </div>

                                            <div class="custom-control custom-radio col-6 mb-2">
                                                <input type="radio" value="vkontakte" id="reg_on_vkontakte" name="reg_type" class="custom-control-input" data-select-text="Регистрация с помощью Вашего аккаунта Вконтакте (мы не публикуем данные из Вашего профиля)">
                                                <label class="custom-control-label" for="reg_on_vkontakte"><i class="fab fa-vk fa-lg mt-1"></i></label>
                                            </div>

                                            <div class="custom-control custom-radio col-6 mb-2">
                                                <input type="radio" value="instagram" id="reg_on_instagram" name="reg_type" class="custom-control-input" data-select-text="Регистрация с помощью Вашего аккаунта Instagram (мы не публикуем данные из Вашего профиля)">
                                                <label class="custom-control-label" for="reg_on_instagram"><i class="fab fa-lg fa-instagram mt-1"></i></label>
                                            </div>

                                            <div class="custom-control custom-radio col-6 mb-2">
                                                <input type="radio" value="facebook" id="reg_on_facebook" name="reg_type" class="custom-control-input" data-select-text="Регистрация с помощью Вашего аккаунта Facebook (мы не публикуем данные из Вашего профиля)">
                                                <label class="custom-control-label" for="reg_on_facebook"><i class="fab fa-lg fa-facebook-f mt-1"></i></label>
                                            </div>

                                            <div class="custom-control custom-radio col-6 mb-2">
                                                <input type="radio" value="google" id="reg_on_google" name="reg_type" class="custom-control-input" data-select-text="Регистрация с помощью Вашего аккаунта Google (мы не публикуем данные из Вашего профиля)">
                                                <label class="custom-control-label" for="reg_on_google"><i class="fab fa-lg fa-google-plus-g mt-1"></i></label>
                                            </div>

                                            <div class="custom-control custom-radio col-12 mb-2">
                                                <input type="radio" value="" id="reg_on_none" name="reg_type" class="custom-control-input" data-select-text="">
                                                <label class="custom-control-label" for="reg_on_none">Без регистрации (не рекомендуется)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="check_text text-primary"></div>

                                <div class="mt-2">
                                    <h5>Для чего нужна регистрация?</h5>
                                    <p>Заказывая еду из ресторанов с помощью сервиса Едошка, вы  накапливаете баллы, которые впоследствии сможете потратить. Каждые 100 рублей в заказе приносят вам <b>1 балл. 1 балл = 1 рубль</b>. При помощи баллов можно оплатить заказ как частично, так и полностью! Обратите внимание, что баллов должно хватать хотя бы на  самое дешевое блюдо из заказа, так как частичная оплата блюда баллами невозможна.</p>
                                    <p class="mb-0"><b>Баллы являются дополнительным бонусом сервиса и никак не связаны с акциями ресторанов - заказывая еду через Едошку, вы получаете и баллы, и все акции, действующие в выбранном вами ресторане!</b></p>
                                </div>

                                <div class="form-inline">

                                </div>
                            </div>
                        @endif

                        @if(!$_cart_restaurants_out_worktime)
                            <div class="d-lg-flex justify-content-between">
                                <div class="pt-lg-2 order-1 mb-lg-0 mb-3">
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" name="accept_policy" value="1" class="custom-control-input" id="accept_policy"{{ isset($_user) && $_user->accept_policy ? ' checked' : '' }}>
                                        <label class="custom-control-label" for="accept_policy">Согласен(а) с <a href="{{ route('site.article', 'policy') }}">Политикой конфиденциальности</a></label>
                                    </div>
                                </div>
                                <div class="d-block d-lg-flex order-0">
                                    <button class="btn btn-success btn-lg submit d-block d-lg-inline-block w-100">Отправить заказ</button>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>

            </div>

        </div>
    </div>
</div>
