@extends('site.layouts.auth', ['body_class'=>'auth_page d-flex align-content-sm-center align-content-start flex-wrap mt-2 mt-sm-0'])
@section('content')

<div class="form_box mx-auto px-3 py-3">
    <a href="{{ route('site.home') }}" class="btn btn-outline-secondary btn-block mb-3"><i class="fas fa-undo mr-2"></i> Назад к сайту</a>
    <h4>Восстановление доступа</h4>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            Ссылка для восстановления пароля была отправлена на Ваш email.
        </div>
    @endif
    <p>Прежде чем продолжить, проверьте свою электронную почту на наличие ссылки для восстановления.</p>
    <p>Если Вы не получали письма, <a href="{{ route('verification.resend') }}">нажмите для повторной отправки</a>.</p>
</div>
@endsection
