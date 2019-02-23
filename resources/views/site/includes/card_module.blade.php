<div class="card__module">
    <div class="container">

        <div class="d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center">
                <div class="svg_image"></div>

                <div class="h4 text-white ml-2 font-weight-light text-uppercase mb-0 d-md-block d-none">
                    Корзина
                </div>

                <div class="h4 text-white ml-3 font-weight-light  mb-0 d-md-none d-block">
                    500₽
                </div>

            </div>

            <div class="h4 text-white ml-2 font-weight-light mb-0 d-md-block d-none">
                Выбрано: 3
            </div>

            <div class="h4 text-white ml-2  mb-0 d-md-block d-none">
                Сумма: 500₽
            </div>

            <div class="">
                <button class="btn btn-light" data-toggle="modal" data-target="#card__module_modal">Оформить заказ</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade product" id="card__module_modal" tabindex="-1" role="dialog" aria-labelledby="card__module_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>

            <div class="modal-body">
                <div class="h2 mb-4" id="card__module_modal_title">Оформление заказа</div>

                <div class="card_products mb-4">
                    <div class="h4 text-uppercase font-weight-light mb-3 text-black">Ваш заказ</div>

                    <table class="table items table-sm">
                        <tr class="item">
                            <td>
                                <div class="image">
                                    <img src="/images/theme/roll1.jpg" alt="">
                                </div>
                            </td>
                            <td class="font-weight-bold">
                                Роллы "Вулкан"
                                <span class="ml-2 text-secondary font-weight-normal">270/8 шт</span>
                            </td>
                            <td class="count">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm" type="button"><i class="fas fa-minus fa-sm"></i></button>
                                    </div>
                                    <input type="number" min="0" value="1" class="form-control form-control-sm">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm" type="button"><i class="fas fa-plus fa-sm"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap text-center">
                                <div class="h4 mb-0">
                                    99 ₽
                                </div>
                            </td>
                            <td class="remove">
                                <a href="javascript:;"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                        <tr class="item">
                            <td>
                                <div class="image">
                                    <img src="/images/theme/roll1.jpg" alt="">
                                </div>
                            </td>
                            <td class="font-weight-bold">
                                Роллы "Вулкан"
                                <span class="ml-2 text-secondary font-weight-normal">270/8 шт</span>
                            </td>
                            <td class="count">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm" type="button"><i class="fas fa-minus fa-sm"></i></button>
                                    </div>
                                    <input type="number" min="0" value="1" class="form-control form-control-sm">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm" type="button"><i class="fas fa-plus fa-sm"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap text-center">
                                <div class="h4 mb-0">
                                    99 ₽
                                </div>
                            </td>
                            <td class="remove">
                                <a href="javascript:;"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">
                                <div class="h4 text-secondary font-weight-light mb-0">Сумма заказа</div>
                            </td>
                            <td class="text-nowrap text-center">
                                <div class="h4 mb-0">
                                    180₽
                                </div>
                            </td>
                            <td></td>
                        </tr>

                    </table>
                </div>

                <div class="card_order_info mb-4">
                    <div class="h4 text-uppercase font-weight-light mb-3 text-black">Данные для оформления</div>

                    <form action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input type="text" class="form-control" id="phone" aria-describedby="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guest">Кол-во приборов</label>
                                    <input type="number" class="form-control" id="guest" aria-describedby="guest">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Имя</label>
                                    <input type="text" class="form-control" id="name" aria-describedby="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="street">Улица</label>
                                    <input type="text" class="form-control" id="street" aria-describedby="street">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" aria-describedby="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="home">Дом</label>
                                    <input type="text" class="form-control" id="home" aria-describedby="home">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dop">Пожелания</label>
                            <textarea name="dop" class="form-control" id="dop" aria-describedby="dop" rows="4"></textarea>
                        </div>

                    </form>
                </div>

                <div class="card_order_info mb-5">
                    <div class="h4 text-uppercase font-weight-light mb-3 text-black">Оплата</div>

                    <div class="form-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="pay_1" name="customRadio" class="custom-control-input" checked>
                            <label class="custom-control-label" for="pay">При получении</label>
                        </div>

                        {{--<div class="custom-control custom-radio ml-2">--}}
                            {{--<input type="radio" id="pay_2" name="pay" class="custom-control-input" disabled>--}}
                            {{--<label class="custom-control-label" for="pay_2">Онлайн</label>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <button class="btn btn-success btn-lg">Отправить заказ</button>


            </div>

        </div>
    </div>
</div>