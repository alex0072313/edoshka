@extends('layouts.admin')

@section('content')

    <form action="{{ isset($user) ? route('admin.presents.update', ['user' => $user->id]) : route('admin.presents.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif
        <div class="form-group row">
            <label class="col-form-label col-md-3">Имя</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{  old('name') ? old('name') : isset($user) ? $user->name : '' }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Фамилия</label>
            <div class="col-md-9">
                <input type="text" name="lastname" value="{{  old('lastname') ? old('lastname') : isset($user) ? $user->lastname : '' }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Email</label>
            <div class="col-md-9">
                <input type="email" name="email" value="{{  old('email') ? old('email') : isset($user) ? $user->email : '' }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Телефон</label>
            <div class="col-md-9">
                <input type="text" name="phone" value="{{  old('phone') ? old('phone') : isset($user) ? $user->phone : '' }}" class="form-control">
                <small class="text-secondary">Используется для SMS уведомлений</small>
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

        <h4>{{ isset($user->id) ? 'Сменить' : 'Задать' }} пароль</h4>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Пароль</label>
            <div class="col-md-9">
                <input name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Введите новый пароль"/>
                @if($errors->has('password'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Повторите пароль</label>
            <div class="col-md-9">
                <input name="password_confirmation" id="password_confirmation" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" placeholder="Повторите пароль" />
                @if($errors->has('password_confirmation'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($user) && auth()->user()->hasRole('megaroot'))
                    <a href="{{ route('admin.presents.destroy', $user->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить представителя {{ $user->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
            </div>
        </div>

    </form>

@endsection
