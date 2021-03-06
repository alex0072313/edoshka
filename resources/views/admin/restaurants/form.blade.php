@extends('layouts.admin')

@section('content')

    <form action="{{ isset($restaurant->id) ? route('admin.restaurants.update', $restaurant->id) : route('admin.restaurants.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        @if(isset($restaurant->id))
            @method('PUT')
        @endif

        @if($_user->hasRole('root|megaroot'))
            <div class="form-group row">
                <label class="col-form-label col-md-3">Город</label>

                <div class="col-md-9">
                    <select name="town_id" id="dish_cat_select" class="default-select2 form-control{{ $errors->has('town_id') ? ' is-invalid' : '' }}" {{ isset($restaurant->id) ? ' data-dish="'.$restaurant->id.'"' : '' }} data-search="false" data-placeholder="Выберете город">
                        <option></option>
                        @foreach(\App\Town::all() as $town)
                            <option value="{{ $town->id }}"{{ isset($restaurant->id) ? $town->id == $restaurant->town_id ? ' selected':'' : '' }} >{{ $town->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('town_id'))
                        <span class="invalid-feedback" role="alert">
                            Выберете город!
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3">Район</label>

                <div class="col-md-9">
                    <select name="district_id" id="dish_cat_select" class="default-select2 form-control{{ $errors->has('district_id') ? ' is-invalid' : '' }}" {{ isset($restaurant->id) ? ' data-dish="'.$restaurant->id.'"' : '' }} data-search="false" data-placeholder="Выберете район">
                        <option></option>
                        @foreach(\App\District::all() as $district)
                            <option value="{{ $district->id }}"{{ isset($restaurant->id) ? $district->id == $restaurant->district_id ? ' selected':'' : '' }} >{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if($_user->hasRole('megaroot'))
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Представитель</label>
                    <div class="col-md-9">

                        @php
                            $present_id = old('present_id') ? old('present_id') : '';
                            if(isset($restaurant)){
                                if($restaurant->present_id){
                                    $present_id = $restaurant->present_id;
                                }
                            }
                        @endphp

                        <select name="present_id" class="default-select2 form-control" data-placeholder="Выберете представителя">
                            <option></option>
                            @foreach(\App\User::role(['root', 'megaroot'])->get() as $user)
                                <option {{ $present_id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name.($user->lastname ? ' '.$user->lastname : '') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            @if($_user->hasRole('megaroot'))
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Управляющий</label>
                    <div class="col-md-9">

                        @php
                            $boss_id = old('boss_id') ? old('boss_id') : '';
                            if(isset($restaurant)){
                                if($restaurant->boss_id){
                                    $boss_id = $restaurant->boss_id;
                                }
                            }
                        @endphp

                        <select name="boss_id" class="default-select2 form-control" data-placeholder="Выберете управляющего">
                            <option></option>
                            @foreach(\App\User::role(['boss'])->get() as $user)
                                <option {{ $boss_id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name.($user->lastname ? ' '.$user->lastname : '') }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @if ($errors->has('boss_id'))
                            <span class="invalid-feedback d-block" role="alert">
                            Выберете управляющего!
                        </span>
                        @endif
                    </div>
                </div>
            @endif

            <div class="form-group row">
                <label class="col-form-label col-md-3">Название</label>
                <div class="col-md-9">

                    @php
                        $name = old('name') ? old('name') : '';
                        if(isset($restaurant)){
                            if($restaurant->name){
                                $name = $restaurant->name;
                            }
                        }
                    @endphp

                    <input type="text" name="name" value="{{ $name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3">Алиас</label>
                <div class="col-md-9">

                    @php
                        $alias = old('alias') ? old('alias') : '';
                        if(isset($restaurant)){
                            if($restaurant->alias){
                                $alias = $restaurant->alias;
                            }
                        }
                    @endphp

                    <input type="text" name="alias"{{ !$_user->hasRole('megaroot|root') ? ' readonly' : '' }} value="{{ $alias }}" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}">
                    @if ($errors->has('alias'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('alias') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3">Адрес</label>
                <div class="col-md-9">

                    @php
                        $address = old('address') ? old('address') : '';
                        if(isset($restaurant)){
                            if($restaurant->address){
                                $address = $restaurant->address;
                            }
                        }
                    @endphp

                    <input type="text" name="address" value="{{ $address }}" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">
                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('address') }}
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Мин. сумма заказа</label>
            <div class="col-md-9">

                @php
                    $min_sum_order = old('min_sum_order') ? old('min_sum_order') : '';
                    if(isset($restaurant)){
                        if($restaurant->min_sum_order){
                            $min_sum_order = $restaurant->min_sum_order;
                        }
                    }
                @endphp

                <input type="number" name="min_sum_order" min="0" value="{{ $min_sum_order }}" class="form-control{{ $errors->has('min_sum_order') ? ' is-invalid' : '' }}">
                @if ($errors->has('min_sum_order'))
                <span class="invalid-feedback" role="alert">
                        {{ $errors->first('min_sum_order') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Мин. сумма бесплатной доставки</label>
            <div class="col-md-9">

                @php
                    $min_free_delivery = old('min_free_delivery') ? old('min_free_delivery') : '';
                    if(isset($restaurant)){
                        if($restaurant->min_free_delivery){
                            $min_free_delivery = $restaurant->min_free_delivery;
                        }
                    }
                @endphp

                <input type="number" name="min_free_delivery" min="0" value="{{ $min_free_delivery }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Ком-рий к доставке</label>
            <div class="col-md-9">
                @php
                    $comment_delivery = old('comment_delivery') ? old('comment_delivery') : '';
                    if(isset($restaurant)){
                        if($restaurant->comment_delivery){
                            $comment_delivery = $restaurant->comment_delivery;
                        }
                    }
                @endphp
                <textarea name="comment_delivery" class="form-control" rows="4">{{ $comment_delivery }}</textarea>
            </div>
        </div>

        @hasrole('megaroot')
            <div class="form-group row">
                <label class="col-form-label col-md-3">Комиссия %</label>
                <div class="col-md-9">
                    @php
                        $commission = old('commission') ? old('commission') : '';
                        if(isset($restaurant)){
                            if($restaurant->commission){
                                $commission = $restaurant->commission;
                            }
                        }
                    @endphp
                    <input type="text" name="commission" min="0" value="{{ $commission }}" class="form-control{{ $errors->has('commission') ? ' is-invalid' : '' }}">
                    @if ($errors->has('commission'))
                        <span class="invalid-feedback" role="alert">
                            {{ $errors->first('commission') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3">ID Telegram Chanell</label>
                <div class="col-md-9">

                    @php
                        $telegram_chat_id = old('telegram_chat_id') ? old('telegram_chat_id') : '';
                        if(isset($restaurant)){
                            if($restaurant->telegram_chat_id){
                                $telegram_chat_id = $restaurant->telegram_chat_id;
                            }
                        }
                    @endphp

                    <input type="text" name="telegram_chat_id" value="{{ $telegram_chat_id }}" class="form-control">
                </div>
            </div>
        @endrole

        <div class="form-group row">
            <label class="col-form-label col-md-3">Время работы (в 24 формате)</label>
            <div class="col-md-9">
                <div class="form-inline">
                    @php
                        $worktime_ot = old('worktime_ot') ? old('worktime_ot') : '';
                        if(isset($restaurant) && isset($restaurant->worktime[0])){
                            if($restaurant->worktime[0]){
                                $worktime_ot = $restaurant->worktime[0];
                            }
                        }

                        $worktime_do = old('worktime_do') ? old('worktime_do') : '';
                        if(isset($restaurant) && isset($restaurant->worktime[1])){
                            if($restaurant->worktime[1]){
                                $worktime_do = $restaurant->worktime[1];
                            }
                        }
                    @endphp

                    <input type="text" name="worktime_ot" value="{{ $worktime_ot }}" class="form-control" placeholder="Например: 09:00">
                    <label class="mx-3"> - </label>
                    <input type="text" name="worktime_do" value="{{ $worktime_do }}" class="form-control" placeholder="Например: 23:00">
                </div>
                @if ($errors->has('worktime_ot') || $errors->has('worktime_do'))
                    <span class="invalid-feedback d-block" role="alert">
                        Нерпавильно указанно время!
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Описание (кратко)</label>
            <div class="col-md-9">
                @php
                    $description = old('description') ? old('description') : '';
                    if(isset($restaurant)){
                        if($restaurant->description){
                            $description = $restaurant->description;
                        }
                    }
                @endphp
                <textarea name="description" class="form-control" rows="4">{{ $description }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Основное фото</label>
            <div class="col-md-9">
                @if(isset($restaurant->id) && Storage::disk('public')->exists('restaurant_imgs/'.$restaurant->id.'/thumb_m.jpg'))
                    <div class="mb-3">
                        <img src="{{ Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/thumb_m.jpg') }}" alt="">
                    </div>
                @endif
                <input type="file" name="bg" class="form-control-file">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Акции</label>
            <div class="col-md-9">
                <select class="default-select2 form-control" name="specials[]" id="specials_select" multiple data-search="true" data-placeholder="Выберете блюда">
                    @foreach($specials as $special)
                        <option value="{{ $special->id }}" {{ isset($restaurant_specials) ? $restaurant_specials->find($special->id) ? ' selected' : '' : '' }}>{{ $special->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Кухни</label>
            <div class="col-md-9">
                <select class="default-select2 form-control" name="kitchens[]" id="kitchens_select" multiple data-search="true" data-placeholder="Выберете блюда">
                    @foreach($kitchens as $kitchen)
                        <option value="{{ $kitchen->id }}" {{ isset($restaurant_kitchens) ? $restaurant_kitchens->find($kitchen->id) ? ' selected' : '' : '' }}>{{ $kitchen->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @role('megaroot|root')
            <div class="form-group row">
                <label class="col-form-label col-md-3">Активен</label>
                <div class="col-md-9">
                    <div class="checkbox checkbox-css on_g">
                        <input type="checkbox" name="active" id="active" value="1"{{ isset($restaurant->id) ? $restaurant->active || old('active') ? ' checked':'':'' }} />
                        <label for="active">&nbsp;</label>
                    </div>
                </div>
            </div>
        @endrole
        <div class="form-group">
            <div>
                <input type="submit" class="btn btn-sm btn-primary" value="Сохранить">
            </div>
        </div>

    </form>

@endsection

@push('js')
    <script>
        $('input[name=\"name\"]').on('change', function () {
            var input_name = $(this),
                input_alias = $('input[name=\"alias\"]');

            if(!input_alias.val()) input_alias.val(rus_to_latin(input_name.val()));
        });

        if(!$('input[name=\"name\"]').val()){
            $('input[name=\"name\"]').trigger('change');
        }
    </script>
@endpush
