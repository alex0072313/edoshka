@extends('layouts.admin')

@section('content')

    <form action="{{ isset($restaurant->id) ? route('admin.restaurants.update', $restaurant->id) : route('admin.restaurants.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        @if(isset($restaurant->id))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Город</label>

            <div class="col-md-9">
                <select name="town_id" id="dish_cat_select" class="default-select2 form-control{{ $errors->has('town_id') ? ' is-invalid' : '' }}" {{ isset($restaurant) ? ' data-dish="'.$restaurant->id.'"' : '' }} data-search="false" data-placeholder="Выберете город">
                    <option></option>
                    @foreach(\App\Town::all() as $town)
                        <option value="{{ $town->id }}"{{ isset($restaurant) ? $town->id == $restaurant->town_id ? ' selected':'' : '' }} >{{ $town->name }}</option>
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
            <label class="col-form-label col-md-3">Название</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{  old('name') ? old('name') : isset($restaurant->id) ? $restaurant->name : '' }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
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
                <input type="text" name="alias"{{ !$_user->hasRole('megaroot') ? ' readonly' : '' }} value="{{ old('alias') ? old('alias') : (isset($restaurant) ? $restaurant->alias : '') }}" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}">
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
                <input type="text" name="address" value="{{  old('address') ? old('address') : isset($restaurant->id) ? $restaurant->address : '' }}" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">
                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('address') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Мин. сумма заказа</label>
            <div class="col-md-9">
                <input type="number" name="min_sum_order" min="0" value="{{  old('min_sum_order') ? old('min_sum_order') : isset($restaurant->id) ? $restaurant->min_sum_order : '' }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Описание (кратко)</label>
            <div class="col-md-9">
                <textarea name="description" class="form-control" rows="4">{{  old('description') ? old('description') : isset($restaurant->id) ? $restaurant->description : '' }}</textarea>
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

            input_alias.val(rus_to_latin(input_name.val()));
        }).trigger('change');
    </script>
@endpush