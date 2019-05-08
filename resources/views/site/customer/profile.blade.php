@extends('layouts.customer')

@section('customer_content')
    <div class="h2 mb-4">Редактировать профиль</div>

    <form action="{{ route('customer.profile', $user->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        <div class="h4 text-uppercase font-weight-light mb-3 text-black">Основная информация</div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Имя <b class="text-danger">*</b></label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{  old('name') ? old('name') : $user->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Email <b class="text-danger">*</b></label>
            <div class="col-md-9">
                <input type="email" name="email" value="{{  old('email') ? old('email') : $user->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
                @if ($user->provider != 'email')
                    <small class="text-secondary">Был создан автоматически, на него нельзя принимать письма, используется только для входа на сайт.</small>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Телефон <b class="text-danger">*</b></label>
            <div class="col-md-9">
                <input type="text" name="phone" value="{{  old('phone') ? old('phone') : $user->phone }}" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Фамилия</label>
            <div class="col-md-9">
                <input type="text" name="lastname" value="{{  old('lastname') ? old('lastname') : $user->lastname }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Аватар</label>
            <div class="col-md-9">
                @if(isset($user->id) && Storage::disk('public')->exists('user_imgs/'.$user->id.'/thumb_m.jpg'))
                    <div class="mb-3">
                        <img src="{{ Storage::disk('public')->url('user_imgs/'.$user->id.'/thumb_m.jpg') }}" alt="">
                    </div>
                @endif
                <input type="file" name="avatar" class="form-control-file">
            </div>
        </div>


        <div class="h4 text-uppercase font-weight-light mb-3 text-black mt-4">Адрес доставки</div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Улица</label>
            <div class="col-md-9">
                <input type="text" name="street" value="{{ old('street') ? old('street') : $user->street}}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Дом (+квартира)</label>
            <div class="col-md-9">
                <input type="text" name="home" value="{{ old('home') ? old('home') : $user->home }}" class="form-control">
            </div>
        </div>

        <div class="h4 text-uppercase font-weight-light mb-3 text-black mt-4">Вход на сайт</div>

        @php
            $user->provider = 'email';
        @endphp

        @switch($user->provider)

            @case('email')

                <div class="form-group">
                    <div class="text-secondary">
                        При входе на сайт - используйте логин <b>{{ $user->email }}</b> и пароль из письма
                    </div>
                </div>

                {{--<div class="form-group row">--}}
                    {{--<label class="col-form-label col-md-3">Пароль</label>--}}
                    {{--<div class="col-md-9">--}}
                        {{--<input name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Введите новый пароль"/>--}}
                        {{--@if($errors->has('password'))--}}
                            {{--<div class="invalid-feedback d-block">--}}
                                {{--{{ $errors->first('password') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group row">--}}
                    {{--<label class="col-form-label col-md-3">Повторите пароль</label>--}}
                    {{--<div class="col-md-9">--}}
                        {{--<input name="password_confirmation" id="password_confirmation" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" placeholder="Повторите пароль" />--}}
                        {{--@if($errors->has('password_confirmation'))--}}
                            {{--<div class="invalid-feedback d-block">--}}
                                {{--{{ $errors->first('password_confirmation') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}

            @break

            @case('phone')
                <div class="form-group">
                    <div class="text-secondary">
                        При входе на сайт - используйте логин <b>{{ $user->phone }}</b> и пароль из смс
                    </div>
                </div>
            @break

            @case('vkontakte')
                <div class="form-group">
                    <div class="text-secondary">
                        <i class="fab fa-vk mt-1"></i> При входе на сайт - используйте свой аккаунт Вконтакте
                    </div>
                </div>
            @break

            @case('facebook')
                <div class="form-group">
                    <div class="text-secondary">
                        <i class="fab fa-facebook-f mt-1"></i> При входе на сайт - используйте свой аккаунт Facebook
                    </div>
                </div>
            @break

            @case('instagram')
                <div class="form-group">
                    <div class="text-secondary">
                        <i class="fab fa-instagram mt-1"></i> При входе на сайт - используйте свой аккаунт Instagram
                    </div>
                </div>
            @break

            @case('google')
                <div class="form-group">
                    <div class="text-secondary">
                        <i class="fab fa-google-plus-g mt-1"></i> При входе на сайт - используйте свой аккаунт Google
                    </div>
                </div>
            @break

        @endswitch

        <div class="h4 text-uppercase font-weight-light mb-3 text-black mt-4">Уведомления и политика</div>

        <div class="form-group">
            <div class="custom-control custom-checkbox mt-1">
                <input type="checkbox" name="responder" value="1" class="custom-control-input" id="responder"{{ $user->responder ? ' checked' : ''  }}>
                <label class="custom-control-label" for="responder">Получать уведомления о скидках и акциях</label>
            </div>
        </div>

        <div class="form-group">
            <div class="custom-control custom-checkbox mt-1">
                <input type="checkbox" name="accept_policy" value="1" class="custom-control-input" id="accept_policy"{{ $user->accept_policy ? ' checked' : ''  }}>
                <label class="custom-control-label" for="accept_policy">Согласен(а) с <a href="https://edoshka.loc/policy">Политикой конфиденциальности</a></label>
            </div>
            @if($errors->has('accept_policy'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('accept_policy') }}
                </div>
            @endif
        </div>

        <div class="form-group mt-4">
            <div class="clearfix">
                <input type="submit" class="btn btn-primary btn-lg float-left" value="Сохранить">
                {{--@if(isset($user))--}}
                    {{--<a href="{{ route('admin.users.destroy', $user->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить пользователя {{ $user->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>--}}
                {{--@endif--}}
            </div>
        </div>

    </form>

@endsection
