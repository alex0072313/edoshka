@extends('site.layouts.auth', ['body_class'=>'auth_page d-flex align-content-sm-center align-content-start flex-wrap mt-2 mt-sm-0'])
@section('content')

<div class="form_box mx-auto px-3 py-3">
    <a href="{{ route('site.home') }}" class="btn btn-outline-secondary btn-block mb-3"><i class="fas fa-undo mr-2"></i> Назад к сайту</a>
    <h4>Смена пароля</h4>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row">
            <label for="email">Ваш email</label>

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group row">
            <label for="password">Новый пароль</label>

            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group row">
            <label for="password-confirm">Повторите пароль</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group mb-0 d-flex">
            <div>
                <button type="submit" class="btn btn-primary">
                    Установить пароль
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
