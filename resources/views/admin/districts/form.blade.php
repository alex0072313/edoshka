@extends('layouts.admin')

@section('content')
    <form action="{{ isset($district) ? route('admin.districts.update', $district->id) : route('admin.districts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($district))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Город</label>

            <div class="col-md-9">
                <select name="town_id" class="default-select2 form-control{{ $errors->has('town_id') ? ' is-invalid' : '' }}" {{ isset($district->id) ? ' data-dish="'.$district->id.'"' : '' }} data-search="false" data-placeholder="Выберете город">
                    <option></option>
                    @foreach($towns as $town)
                        <option value="{{ $town->id }}"{{ isset($district->id) ? $town->id == $district->town_id ? ' selected':'' : '' }} >{{ $town->name }}</option>
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
                <input type="text" name="name" value="{{ old('name') ? old('name') : (isset($district) ? $district->name : '') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       placeholder="Название района"
                       data-parsley-required="true"
                >
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Доп. название 2</label>
            <div class="col-md-9">
                <input type="text" name="name2" value="{{ old('name2') ? old('name2') : (isset($district) ? $district->name2 : '') }}" class="form-control" placeholder="Название 2 (напр. Лазаревского р-на)">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Доп. название 3</label>
            <div class="col-md-9">
                <input type="text" name="name3" value="{{ old('name3') ? old('name3') : (isset($district) ? $district->name3 : '') }}" class="form-control" placeholder="Название 3 (напр. Лазаревском р-не)">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Алиас</label>
            <div class="col-md-9">
                <input type="text" name="alias"{{ !$_user->hasRole('megaroot') ? ' readonly' : '' }} value="{{ old('alias') ? old('alias') : (isset($district) ? $district->alias : '') }}" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}">
                @if ($errors->has('alias'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('alias') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($district))
                    <a href="{{ route('admin.districts.destroy', $district->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить район {{ $district->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
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
