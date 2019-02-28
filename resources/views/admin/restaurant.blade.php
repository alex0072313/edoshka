@extends('layouts.admin')

@section('content')

    <form action="{{ route('admin.restaurant') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        <div class="form-group row">
            <label class="col-form-label col-md-3">Название</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{  old('name') ? old('name') : $restaurant->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Адрес</label>
            <div class="col-md-9">
                <input type="text" name="address" value="{{  old('address') ? old('address') : $restaurant->address }}" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">
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
                <input type="number" name="min_sum_order" min="0" value="{{  old('min_sum_order') ? old('min_sum_order') : $restaurant->min_sum_order }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Описание (кратко)</label>
            <div class="col-md-9">
                <textarea name="description" class="form-control" rows="4">{{  old('description') ? old('description') : $restaurant->description }}</textarea>
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