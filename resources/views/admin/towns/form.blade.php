@extends('layouts.admin')

@section('content')
    <form action="{{ isset($town) ? route('admin.towns.update', $town->id) : route('admin.towns.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($town))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Название</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{ old('name') ? old('name') : (isset($town) ? $town->name : '') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       placeholder="Название города"
                       data-parsley-required="true"
                >
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($town))
                    <a href="{{ route('admin.towns.destroy', $town->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить город {{ $town->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
            </div>
        </div>
    </form>
@endsection