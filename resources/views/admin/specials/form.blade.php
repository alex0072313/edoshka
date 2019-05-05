@extends('layouts.admin')

@section('content')
    <form action="{{ isset($special) ? route('admin.specials.update', $special->id) : route('admin.specials.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($special))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Название</label>
            <div class="col-md-9">
                <input type="text" name="name" value="{{ old('name') ? old('name') : (isset($special) ? $special->name : '') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       placeholder="Название акции"
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
            <label class="col-form-label col-md-3">Описание (кратко)</label>
            <div class="col-md-9">
                <textarea name="content" class="form-control" rows="4">{{  old('content') ? old('content') : isset($special->id) ? $special->content : '' }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Основное изображение</label>
            <div class="col-md-9">

                @if(isset($special->id) && Storage::disk('public')->exists('special_imgs/'.$special->id.'/img_s.jpg'))
                    <div class="mb-3">
                        <img src="{{ Storage::disk('public')->url('special_imgs/'.$special->id.'/img_s.jpg') }}" alt="">
                    </div>
                @endif

                <input type="file" name="image" class="form-control-file">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Включена</label>
            <div class="col-md-9">
                <div class="checkbox checkbox-css on_g">
                    <input type="checkbox" name="status" id="status" value="1"{{ isset($special->id) ? $special->status || old('status') ? ' checked':'':'' }} />
                    <label for="status">&nbsp;</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($special))
                    <a href="{{ route('admin.specials.destroy', $special->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить акцию {{ $special->name }}{{ $special->restaurants()->count() ? '(привязана к '.$special->restaurants()->count().' ресторану(нам))':'' }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
            </div>
        </div>
    </form>
@endsection
