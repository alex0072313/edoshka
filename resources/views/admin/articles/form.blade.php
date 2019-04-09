@extends('layouts.admin')

@section('content')
    <form action="{{ isset($article) ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($article))
            @method('PUT')
        @endif

        <div class="form-group row">
            <label class="col-form-label col-md-3">Заголовок</label>
            <div class="col-md-9">
                <input type="text" name="title"
                       value="{{ old('title') ? old('title') : (isset($article) ? $article->title : '') }}"
                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('title') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Алиас</label>
            <div class="col-md-9">
                <input type="text" name="alias"
                       value="{{ old('alias') ? old('alias') : (isset($article) ? $article->alias : '') }}"
                       class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}">
                @if ($errors->has('alias'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('alias') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Доп. заголовок</label>
            <div class="col-md-9">
                <input type="text" name="long_title"
                       value="{{ old('long_title') ? old('long_title') : (isset($article) ? $article->long_title : '') }}"
                       class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Содержимое</label>
            <div class="col-md-9">
                <textarea class="summernote"
                          name="text">{{ old('text') ? old('text') : (isset($article) ? $article->text : '') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                @if(isset($article))
                    <a href="{{ route('admin.articles.destroy', $article->id) }}" data-click="swal-warning"
                       data-title="Подтвердите действие" data-text="Удалить статью {{ $article->name }}?"
                       data-classbtn="danger" data-actionbtn="Удалить" data-type="error"
                       class="btn btn-sm btn-danger float-right">Удалить</a>
                @endif
            </div>
        </div>
    </form>
@endsection



@push('css')
    <link href="/assets/plugins/summernote/summernote.css" rel="stylesheet"/>
@endpush

@push('js')
    <script>
        $('input[name=\"title\"]').on('change', function () {
            var input_name = $(this),
                input_alias = $('input[name=\"alias\"]');

            if(!input_alias.val())
                input_alias.val(rus_to_latin(input_name.val()));
        }).trigger('change');
    </script>
    <script src="/assets/plugins/summernote/summernote.min.js"></script>

    <script>
        $(".summernote").summernote({
            placeholder: "Статья...",
            //height: $(window).height() - $(".summernote").offset().top - 80
        });

    </script>
@endpush
