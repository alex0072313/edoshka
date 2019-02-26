@extends('layouts.auth', ['body_class'=>'auth_page d-flex align-content-sm-center align-content-start flex-wrap mt-2 mt-sm-0'])
@section('content')
    <div class="form_box mx-auto px-3 py-3">
        <a href="{{ route('site.home') }}" class="btn btn-outline-secondary btn-block mb-3"><i class="fas fa-undo mr-2"></i> Назад к сайту</a>
        <h4>Восстановление доступа</h4>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Ваш email</label>

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group mb-0 d-flex">
                <div>
                    <button type="submit" class="btn btn-primary">
                        Восстановить пароль
                    </button>
                </div>
                <div class="flex-grow-1 text-right pt-2">
                    <a href="{{ route('login') }}" class="ml-2">
                        Войти
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
