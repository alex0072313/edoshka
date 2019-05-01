@extends('layouts.auth', ['body_class'=>'auth_page d-flex align-content-sm-center align-content-start flex-wrap mt-2 mt-sm-0', 'title'=>'Вход в личный кабинет'])

@section('content')
    <div class="form_box mx-auto px-3 py-3">

        <a href="{{ route('site.home') }}" class="btn btn-outline-secondary btn-block mb-3"><i class="fas fa-undo mr-2"></i> Назад к сайту</a>

        <h4>Вход в кабинет</h4>

        <a href="{{ route('login_soc', 'facebook') }}">facebook</a>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Ваш email</label>

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Ваш пароль</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">Запомнить на этом браузере</label>
                </div>
            </div>

            <div class="form-group mb-0 d-flex">
                <div>
                    <button type="submit" class="btn btn-primary">
                        Вход
                    </button>
                </div>
                @if (Route::has('password.request'))
                    <div class="flex-grow-1 text-right pt-2">
                        <a href="{{ route('password.request') }}" class="ml-2">
                            Восстановление пароля
                        </a>
                    </div>
                @endif
            </div>
        </form>
    </div>

@endsection
