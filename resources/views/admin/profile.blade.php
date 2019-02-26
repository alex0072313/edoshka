@extends('layouts.admin')

@section('content')

    <form action="{{ route('admin.profile') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        <div class="form-group row">
            <label class="col-form-label col-md-3">Имя</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{  old('name') ? old('name') : $user->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Ваше Имя">
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
                <input type="text" name="lastname" value="{{  old('lastname') ? old('lastname') : $user->lastname }}" class="form-control" placeholder="Ваша Фамилия">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Email</label>
            <div class="col-md-9">
                <input type="email" name="email" value="{{  old('email') ? old('email') : $user->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Ваш Email">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
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

        <h4>Сменить пароль</h4>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Новый пароль</label>
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
            <div>
                <input type="submit" class="btn btn-sm btn-primary" value="Сохранить">
            </div>
        </div>

    </form>

@endsection