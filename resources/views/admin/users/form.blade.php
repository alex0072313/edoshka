@extends('layouts.admin')

@section('content')

    <form action="{{ isset($user) ? route('admin.users.update', ['user' => $user->id]) : route('admin.users.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif


        @if(Auth::user()->hasRole('megaroot'))
            <div class="form-group row">
                <label class="col-form-label col-md-3">Ресторан</label>

                <div class="col-md-9">
                    <select name="restaurant_id" class="default-select2 form-control" data-placeholder="Выберете ресторан">
                        <option></option>
                        @foreach(\App\Restaurant::all() as $restaurant)
                            <option {{ isset($user) && isset($user->restaurant->id) && ($user->restaurant->id == $restaurant->id) ? 'selected' : '' }} value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback d-block" role="alert">
                            Выберете ресторан!
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3">Роль</label>

                <div class="col-md-9">
                    <select name="role" class="default-select2 form-control" data-placeholder="Выберете роль">
                        <option></option>
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            @continue($role->name == 'megaroot')
                            <option {{ isset($user) ? $user->hasRole($role->name) ? 'selected' : '' : '' }} value="{{ $role->name }}">{{ config('role.names.'.$role->name.'.dolg') }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="invalid-feedback d-block" role="alert">
                            Выберете роль!
                        </span>
                    @endif
                    {{--<input type="text" disabled readonly="" class="form-control-plaintext" value="{{ config('role.names.'.$user->roles()->get()->first()->name.'.dolg') }}">--}}
                </div>
            </div>
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
            <label class="col-form-label col-md-3">Телефон 2</label>
            <div class="col-md-9">
                <input type="text" name="phone2" value="{{  old('phone2') ? old('phone2') : isset($user) ? $user->phone2 : '' }}" class="form-control">
                <small class="text-secondary">Используется для SMS уведомлений</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Подробный заказ в SMS</label>
            <div class="col-md-9">
                <div class="checkbox checkbox-css on_g">
                    <input type="checkbox" name="order_in_sms" id="order_in_sms" value="1"{{ isset($user->order_in_sms) ? $user->order_in_sms || old('order_in_sms') ? ' checked':'':'' }} />
                    <label for="order_in_sms">&nbsp;</label>
                </div>
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
                @if(isset($user))
                    <a href="{{ route('admin.users.destroy', $user->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить пользователя {{ $user->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
            </div>
        </div>

    </form>

@endsection
