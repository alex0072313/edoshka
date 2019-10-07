@extends('layouts.admin')

@section('content')
    <form action="{{ isset($slide) ? route('admin.slides.update', $slide->id) : route('admin.slides.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($slide))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Город</label>

            <div class="col-md-9">
                <select name="town_id" id="dish_cat_select" class="default-select2 form-control{{ $errors->has('town_id') ? ' is-invalid' : '' }}" {{ isset($slide) ? ' data-dish="'.$slide->id.'"' : '' }} data-search="false" data-placeholder="Выберете город">
                    <option></option>
                    @foreach(\App\Town::all() as $town)
                        <option value="{{ $town->id }}"{{ isset($slide) ? $town->id == $slide->town_id ? ' selected':'' : '' }} >{{ $town->name }}</option>
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
            <label class="col-form-label col-md-3">Заголовок</label>
            <div class="col-md-9">
                <input type="text" name="title" value="{{ old('title') ? old('name') : (isset($slide) ? $slide->title : '') }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Изображение</label>
            <div class="col-md-9">

                @if(isset($slide->id) && Storage::disk('public')->exists('slide_imgs/'.$slide->id.'/img_s.jpg'))
                    <div class="mb-3">
                        <img src="{{ Storage::disk('public')->url('slide_imgs/'.$slide->id.'/img_s.jpg') }}" alt="">
                    </div>
                @endif

                <input type="file" name="image" class="form-control-file">
                @if ($errors->has('image'))
                    <span class="invalid-feedback d-block" role="alert">
                        Загрузите фото!
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Ссылка</label>
            <div class="col-md-9">
                <input type="text" name="href" value="{{ old('href') ? old('href') : (isset($slide) ? $slide->href : '') }}" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Позиция</label>
            <div class="col-md-9">
                <input type="number" min="0" name="pos" value="{{ old('pos') ? old('pos') : (isset($slide) ? $slide->pos : '') }}" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($slide))
                    <a href="{{ route('admin.slides.destroy', $slide->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить слайд?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
            </div>
        </div>
    </form>
@endsection
