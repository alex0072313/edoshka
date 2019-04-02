@push('css')
    <link href="/assets/plugins/dropzone/min/dropzone.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min.css" rel="stylesheet"/>
@endpush

@push('js')
    <script src="https://unpkg.com/web-animations-js@2.3.1/web-animations.min.js"></script>
    <script src="https://unpkg.com/hammerjs@2.0.8/hammer.min.js"></script>
    <script src="https://unpkg.com/muuri@0.7.1/dist/muuri.min.js"></script>

    <script src="/assets/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js"></script>

    <script src="/assets/js/photoboard.js"></script>
    <script src="/assets/js/field_files.js"></script>

    <script>
        {{--if ($('#dish_cat_select').length) {--}}
            {{--var select = $('#dish_cat_select'),--}}
                {{--url;--}}
        
            {{--@if(isset($dish))--}}
                {{--url = '{{ route('fields.get_for_dish', 'dish_'.$dish->id) }}';--}}
            {{--@else--}}
                {{--url = '{{ route('fields.get_for_dish') }}';--}}
            {{--@endif--}}
        
            {{--select.on('change', function () {--}}
                {{--var category_id = $(this).val();--}}
        
                {{--if (!$('.dish_field').length) {--}}
                    {{--$('.primary_info').after(bild_dish_field_form('<div class="fa-3x text-center my-1 text-green"><i class="fas fa-spinner fa-spin"></i></div>'));--}}
                {{--} else {--}}
                    {{--$('.dish_field .panel-body').html('<div class="fa-3x text-center my-3 text-green"><i class="fas fa-spinner fa-spin"></i></div>');--}}
                {{--}--}}
        
                {{--$.ajax({--}}
                    {{--url: url,--}}
                    {{--type: 'POST',--}}
                    {{--data: {--}}
                        {{--_token: '{{ csrf_token() }}',--}}
                        {{--category_id: category_id--}}
                    {{--},--}}
                    {{--dataType: 'JSON',--}}
                    {{--success: function (response) {--}}
                        {{--var fields_html = '';--}}
        
                        {{--if (response['fields'] !== undefined) {--}}
                            {{--for (var i = 0; i < response['fields'].length; i++) {--}}
                                {{--fields_html += response['fields'][i];--}}
                            {{--}--}}
                        {{--}--}}
        
                        {{--if (fields_html) {--}}
                            {{--$('.dish_field .panel-body').html(fields_html);--}}
                        {{--} else {--}}
                            {{--$('.dish_field').remove();--}}
                        {{--}--}}
        
                        {{--bild_htmltext();--}}
                        {{--fields_init();--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        
        {{--}--}}
        {{--bild_htmltext();--}}
        
        {{--//--}}
        {{--function bild_dish_field_form(fields) {--}}
            {{--var html = '<div class="panel panel-inverse dish_field">' +--}}
                {{--'<div class="panel-heading">' +--}}
                {{--'<h4 class="panel-title">Дополнительные поля</h4>' +--}}
                {{--'</div>' +--}}
                {{--'<div class="panel-body panel-form">' +--}}
                {{--fields +--}}
                {{--'</div>' +--}}
                {{--'</div>';--}}
            {{--return html;--}}
        {{--}--}}
        
        {{--function bild_htmltext() {--}}
            {{--$(".wysihtml5").wysihtml5({--}}
                {{--toolbar: {--}}
                    {{--"font-styles": false,--}}
                    {{--"image": false,--}}
                    {{--"size": 'sm'--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

    </script>
@endpush

@extends('layouts.admin')

{{--@if(isset($dish))--}}
    {{----}}
    {{--@section('page_header_buttons')--}}
        {{--<a href="{{ route('categories.create') }}" class="btn btn-green btn-xs m-l-5"><i--}}
                    {{--class="fas fa-sm fa-fw fa-folder-open"></i> Новая категория</a>--}}
    {{--@endsection--}}

{{--@endif--}}

@section('content')

    <form action="{{ isset($dish) ? route('admin.dishes.update', 'dish_'.$dish->id) : route('admin.dishes.store') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($dish))
            @method('PUT')
        @endif
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Название</label>
                    <div class="col-md-9">
                        <input type="text" name="name" id="name_input"
                               value="{{ old('name') ? old('name') : (isset($dish) ? $dish->name : '') }}"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               placeholder="Название блюда"
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
                                    <option value="{{ $restaurant->id }}"{{ isset($dish) ? $restaurant->id == $dish->restaurant_id ? ' selected':'' : '' }} >{{ $restaurant->name . ' - ' . $restaurant->town->name }}</option>
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
                    <label class="col-form-label col-md-3">Категория</label>

                    <div class="col-md-9">
                        <select name="category_id" id="dish_cat_select" class="default-select2 form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" {{ isset($dish) ? ' data-dish="'.$dish->id.'"' : '' }} data-search="true" data-placeholder="Выберете категорию блюда">
                            <option></option>
                            @foreach(App\Category::allToAccess(true) as $cat)
                                @if(isset($category))
                                    <option value="{{ $cat->id }}"{{ $cat->id == $category->id ? ' selected':'' }} >{{ $cat->name }}</option>
                                @else
                                    <option value="{{ $cat->id }}"{{ isset($dish) ? $cat->id == $dish->category_id ? ' selected':'' : '' }} >{{ $cat->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="invalid-feedback" role="alert">
                                    Выберете категорию блюда!
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3">Цена</label>
                    <div class="col-md-9">
                        <input type="number" name="price" min="0" value="{{ old('price') ? old('price') : isset($dish) ? $dish->price : '' }}" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}">
                        @if ($errors->has('price'))
                            <span class="invalid-feedback" role="alert">
                                Укажите цену!
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3">Новая цена</label>
                    <div class="col-md-9">
                        <input type="number" name="new_price" min="0" value="{{ old('new_price') ? old('new_price') : isset($dish) ? $dish->new_price : '' }}" class="form-control">
                        <small class="text-secondary">Используется как цена по акции</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3">Краткое описание (кол-во, вес и т.д)</label>
                    <div class="col-md-9">
                        <textarea name="short_description" class="form-control" rows="4">{{ old('short_description') ? old('short_description') : isset($dish) ? $dish->short_description : '' }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3">Подробное описание (состав, и т.д)</label>
                    <div class="col-md-9">
                        <textarea name="description" class="form-control" rows="4">{{ old('description') ? old('description') : isset($dish) ? $dish->description : '' }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3">Основное изображение</label>
                    <div class="col-md-9">

                        @if(isset($dish->id) && Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_s.jpg'))
                            <div class="mb-3">
                                <img src="{{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_s.jpg') }}" alt="">
                            </div>
                        @endif

                        <input type="file" name="image" class="form-control-file">

                        <div class="checkbox checkbox-css on_g">
                            <input type="checkbox" name="whitespace" id="whitespace" value="1" />
                            <label for="whitespace">Загрузить с белыми полями</label>
                        </div>

                        @if ($errors->has('image'))
                            <span class="invalid-feedback d-block" role="alert">
                                Загрузите фото!
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3">Маркеры</label>
                    <div class="col-md-9">
                        @foreach(\App\Marker::all() as $marker)
                            <div class="checkbox checkbox-css on_g">
                                <input type="checkbox" name="markers[]" id="marker_{{ $marker->id }}" value="{{ $marker->id }}"{{ isset($dish->id) ? $dish->markers()->find($marker->id) ? ' checked':'':'' }} />
                                <label for="marker_{{ $marker->id }}">{{ $marker->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-md-3">Рекомендуемые</label>
                    <div class="col-md-9">

                        <select class="default-select2 form-control" name="recomendeds[]" multiple data-search="true" data-placeholder="Выберете блюда">
                            <option></option>
                            @foreach($recomendeds as $recomended)
                                <option value="{{ $recomended->id }}" {{ isset($dish_recomendeds) ? $dish_recomendeds->find($recomended->id) ? ' selected' : '' : '' }}> {{ Auth::user()->hasRole('megaroot') ? $recomended->restaurant->name . ' / ' : '' }}{{ $recomended->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                {{--<div class="form-group row">--}}
                    {{--<label class="col-form-label col-md-3">Рекомендуемые</label>--}}
                    {{--<div class="col-md-9">--}}
                        {{--<ul id="jquery-tagIt-success" class="primary">--}}
                            {{--<li>Tag1</li>--}}
                            {{--<li>Tag2</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group row">--}}
                    {{--<label class="col-form-label col-md-3">Родительский обьект</label>--}}

                    {{--<div class="col-md-9">--}}
                        {{--<select name="parent_id"--}}
                                {{--class="default-select2 form-control{{ $errors->has('parent_id') ? ' is-invalid' : '' }}"--}}
                                {{--data-search="true" data-placeholder="Родительский обьект">--}}
                            {{--<option></option>--}}
                            {{--<option value="0">-- Без родителя --</option>--}}
                            {{--@foreach(Auth::user()->company->dishsByCat() as $cat_name => $cat)--}}
                                {{--<optgroup label="{{ $cat_name }}">--}}
                                    {{--@foreach($cat as $parent_dish)--}}
                                        {{--@if(isset($dish))--}}
                                            {{--@continue($parent_dish->id == $dish->id)--}}
                                        {{--@endif--}}
                                        {{--<option value="{{ $parent_dish->id }}"{{ isset($dish) ? $parent_dish->id == $dish->parent_id ? ' selected':'' : '' }} >{{ $parent_dish->name }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</optgroup>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}


        {{--@if(isset($fields))--}}
            {{--<div class="panel panel-inverse dish_field">--}}
                {{--<div class="panel-heading">--}}
                    {{--<h4 class="panel-title">Дополнительные поля</h4>--}}
                {{--</div>--}}

                {{--<div class="panel-body panel-form">--}}
                    {{--@foreach($fields as $field)--}}
                        {{--{!! $field !!}--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}


        <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
        @if(isset($dish))
            <a href="{{ route('admin.dishes.destroy', 'dish_'.$dish->id) }}" data-click="swal-warning"
               data-title="Подтвердите действие"
               data-text="Удалить блюдо {{ $dish->name }}?"
               data-classbtn="danger" data-actionbtn="Удалить" data-type="error"
               class="btn btn-sm btn-danger float-right">Удалить</a>
        @endif


    </form>
@endsection

@push('js')
    <script>
        $('#name_input').on('change', function () {
            var input = $(this),
                val = input.val();

            $.ajax({
                type: "POST",
                url: '{{ route('admin.dishes.find_repeat') }}',
                data: {name:val},
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                }
            });


        });
    </script>
@endpush
