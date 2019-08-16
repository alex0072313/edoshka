@extends('layouts.admin')

@section('content')
    <form action="{{ isset($kitchen) ? route('admin.kitchens.update', $kitchen->id) : route('admin.kitchens.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($kitchen))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Название</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{ old('name') ? old('name') : (isset($kitchen) ? $kitchen->name : '') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Описание</label>
            <div class="col-md-9">
                <textarea name="description" class="form-control" rows="4">{{ old('description') ? old('description') : (isset($kitchen) ? $kitchen->description : '') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($kitchen))
                    <a href="{{ route('admin.kitchens.destroy', $kitchen->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить кухню {{ $kitchen->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
            </div>
        </div>
    </form>
@endsection
