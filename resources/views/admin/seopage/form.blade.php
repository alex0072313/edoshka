@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.seopages.save') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label class="col-form-label col-md-3">Title</label>
            <div class="col-md-9">
                <input type="text" name="title" class="form-control" value="{{ $_title }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Description</label>
            <div class="col-md-9">
                <textarea name="description" class="form-control" rows="4">{{ $description }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label col-md-3">Keywords</label>
            <div class="col-md-9">
                <textarea name="keywords" class="form-control" rows="4">{{ $keywords }}</textarea>
            </div>
        </div>

        <input type="hidden" name="url" value="{{ $url }}">
        @if(isset($town))
            <input type="hidden" name="town" value="{{ $town }}">
        @endif
        <div class="form-group">
            <div class="clearfix">
                <input type="submit" class="btn btn-sm btn-primary float-left" value="Сохранить">
            </div>
        </div>
    </form>
@endsection
