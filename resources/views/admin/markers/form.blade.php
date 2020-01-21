@extends('layouts.admin')

@section('content')
    <form action="{{ isset($marker) ? route('admin.markers.update', $marker->id) : route('admin.markers.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($marker))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Название</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{ old('name') ? old('name') : (isset($marker) ? $marker->name : '') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Цвет фона</label>
            <div class="col-md-9">
                <input type="text" name="bg" value="{{ old('bg') ? old('bg') : (isset($marker) ? $marker->bg : '') }}" class="form-control{{ $errors->has('bg') ? ' is-invalid' : '' }}">
                @if ($errors->has('bg'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('bg') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Цвет уголка</label>
            <div class="col-md-9">
                <input type="text" name="border" value="{{ old('border') ? old('border') : (isset($marker) ? $marker->bg : '') }}" class="form-control{{ $errors->has('bg') ? ' is-invalid' : '' }}">
                @if ($errors->has('bg'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('bg') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Цвет текста</label>
            <div class="col-md-9">
                <input type="text" name="color" value="{{ old('color') ? old('color') : (isset($marker) ? $marker->color : '') }}" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}">
                @if ($errors->has('color'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('color') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Содержимое</label>
            <div class="col-md-9">
                <input type="text" name="content" value="{{ old('content') ? old('content') : (isset($marker) ? $marker->content : '') }}" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">
                @if ($errors->has('content'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('content') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($marker))
                    <a href="{{ route('admin.markers.destroy', $marker->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить маркер {{ $marker->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
            </div>
        </div>
    </form>
@endsection
