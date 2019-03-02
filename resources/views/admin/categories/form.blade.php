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