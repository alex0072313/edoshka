<div class="modal fade product" id="user_enter_modal" tabindex="-1" role="dialog" aria-labelledby="user_enter_modal_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body pb-0 pt-0 text-center text-sm-left">

                <div class="row">

                    <div class="col-sm-6 border-right pt-3 pb-0 pb-sm-3">

                        <div class="font-weight-bold text-center text-sm-right mb-2">
                            Вход через аккаунт:
                        </div>

                        <a href="{{ route('login_soc', 'vkontakte') }}"
                           class="btn btn-lg vk soc_btn text-left d-inline-block d-sm-block mb-3 px-4 px-sm-3">
                                    <span class="row">
                                        <span class="px-0 px-sm-3 col-12 col-sm-3 text-center i">
                                            <i class="fab fa-vk"></i>
                                        </span>
                                        <span class="col-9 d-none d-sm-block">
                                            Вконтакте
                                        </span>
                                    </span>
                        </a>

                        <a href="{{ route('login_soc', 'instagram') }}"
                           class="btn btn-lg in soc_btn text-left d-inline-block d-sm-block mb-3 px-4 px-sm-3"">
                                    <span class="row">
                                        <span class="px-0 px-sm-3 col-12 col-sm-3 text-center i">
                                            <i class="fab fa-instagram"></i>
                                        </span>
                                        <span class="col-9 d-none d-sm-block">
                                            Instagram
                                        </span>
                                    </span>
                        </a>

                        <a href="{{ route('login_soc', 'facebook') }}"
                           class="btn btn-lg fb soc_btn text-left d-inline-block d-sm-block mb-3 px-4 px-sm-3"">
                                    <span class="row">
                                        <span class="px-0 px-sm-3 col-12 col-sm-3 text-center i">
                                            <i class="fab fa-facebook-f"></i>
                                        </span>
                                        <span class="col-9 d-none d-sm-block">
                                            Facebook
                                        </span>
                                    </span>
                        </a>

                        {{--<a href="{{ route('login_soc', 'twitter') }}"--}}
                        {{--class="btn btn-lg tw soc_btn text-left btn-block mb-3">--}}
                        {{--<span class="row">--}}
                        {{--<span class="col-3 text-center i">--}}
                        {{--<i class="fab fa-twitter"></i>--}}
                        {{--</span>--}}
                        {{--<span class="col-9">--}}
                        {{--Twitter--}}
                        {{--</span>--}}
                        {{--</span>--}}
                        {{--</a>--}}

                        <a href="{{ route('login_soc', 'google') }}"
                           class="btn btn-lg gl soc_btn text-left d-inline-block d-sm-block mb-3 px-4 px-sm-3"">
                            <span class="row">
                                <span class="px-0 px-sm-3 col-12 col-sm-3 text-center i">
                                    <i class="fab fa-google-plus-g"></i>
                                </span>
                                <span class="col-9 d-none d-sm-block">
                                    Google
                                </span>
                            </span>
                        </a>

                    </div>
                    <div class="col-sm-6 pb-3 pt-0 pt-sm-3">

                        <div class="font-weight-bold mb-2">
                            Вход через Телефон/Email:
                        </div>

                        <div id="login_form" data-action="{{ route('customer_login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email_or_phone" type="text" class="form-control-lg form-control" name="email_or_phone" placeholder="Ваш Телефон или Email" autofocus>
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control-lg form-control" name="password" placeholder="Ваш Пароль">
                            </div>

                            <div class="form-group d-flex justify-content-between">
                                <div class="pt-2">
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" name="remember" value="1" class="custom-control-input" id="remember">
                                        <label class="custom-control-label" for="remember">Запомнить</label>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg px-3 submit">Вход</button>
                                </div>
                            </div>

                            {{--<div class="form-group mb-0">--}}
                                {{--<a href="{{ route('password.request') }}" class="">Зарегистрироваться</a>--}}
                            {{--</div>--}}

                            {{--<div class="form-group mb-0">--}}
                                {{--<a href="{{ route('password.request') }}" class="">Восстановление пароля</a>--}}
                            {{--</div>--}}

                        </div>

                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
