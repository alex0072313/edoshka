@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.helpmsgs.save') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label class="col-form-label col-md-3">Содержимое</label>
            <div class="col-md-9">
                <textarea name="value" class="form-control" rows="4">{{ $value }}</textarea>
            </div>
        </div>

        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="page" value="{{ $page }}">

        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
                {{--@if(isset($helpmsg))--}}
                    {{--<a href="{{ route('admin.helpmsgs.destroy', ['helpmsg_name' => $helpmsg->name]) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить поле {{ $helpmsg->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-sm btn-danger float-right">Удалить</a>--}}
                {{--@endif--}}
            </div>
        </div>
    </form>
@endsection