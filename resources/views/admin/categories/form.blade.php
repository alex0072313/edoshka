@extends('layouts.admin')

@section('content')
    <form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Название</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{ old('name') ? old('name') : (isset($category) ? $category->name : '') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       placeholder="Название категории"
                       data-parsley-required="true"
                >
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        @if(Auth::user()->hasRole('megaroot'))
            <div class="form-group row">
                <label class="col-form-label col-md-3">Ресторан</label>
                <div class="col-md-9">
                    <select name="restaurant_id" class="default-select2 form-control{{ $errors->has('restaurant_id') ? ' is-invalid' : '' }}" {{ isset($dish) ? ' data-dish="'.$dish->id.'"' : '' }} data-search="true" data-placeholder="Выберете ресторан">
                        <option></option>
                        @foreach($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}"{{ isset($category) ? $restaurant->id == $category->restaurant_id ? ' selected':'' : '' }} >{{ $restaurant->name . ' - ' . $restaurant->town->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('restaurant_id'))
                        <span class="invalid-feedback" role="alert">
                                    Выберете ресторан!
                                </span>
                    @endif
                </div>
            </div>
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Алиас</label>
            <div class="col-md-9">
                <input type="text" name="alias"{{ !$_user->hasRole('megaroot') ? ' readonly' : '' }} value="{{ old('alias') ? old('alias') : (isset($category) ? $category->alias : '') }}" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}">
                @if ($errors->has('alias'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('alias') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Основное изображение</label>
            <div class="col-md-9">

                @if(isset($category->id) && Storage::disk('public')->exists('category_imgs/'.$category->id.'/img_s.jpg'))
                    <div class="mb-3">
                        <img src="{{ Storage::disk('public')->url('category_imgs/'.$category->id.'/img_s.jpg') }}" alt="">
                    </div>
                @endif

                <input type="file" name="image" class="form-control-file">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Путь до иконки</label>
            <div class="col-md-9">
                <input type="text" name="icon" value="{{ old('icon') ? old('icon') : (isset($category) ? $category->icon : '') }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Показывать в верхнем меню</label>
            <div class="col-md-9">
                <div class="checkbox checkbox-css on_g">
                    <input type="checkbox" name="topmenu" id="topmenu" value="1"{{ isset($category->id) ? $category->topmenu || old('topmenu') ? ' checked':'':'' }} />
                    <label for="topmenu">&nbsp;</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($category))
                    <a href="{{ route('admin.categories.destroy', $category->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить категорию {{ $category->name }}{{ $category->childs()->count() ? ' и ее потомков':'' }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
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

            input_alias.val(rus_to_latin(input_name.val()));
        }).trigger('change');
    </script>
@endpush
