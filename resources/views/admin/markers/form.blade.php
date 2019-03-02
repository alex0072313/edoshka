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
            <label class="col-form-label col-md-3">CSS клас</label>
            <div class="col-md-9">
                <input type="text" name="css_class" value="{{ old('css_class') ? old('css_class') : (isset($marker) ? $marker->css_class : '') }}" class="form-control{{ $errors->has('css_class') ? ' is-invalid' : '' }}">
                @if ($errors->has('css_class'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('css_class') }}
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