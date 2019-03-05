@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.slides.create') }}" class="btn btn-primary btn-lg mb-4">Добавить слайд</a>
    @if(count($slides))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    <th width="1%" class="pr-0"></th>
                    <th>Заголовок</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($slides as $slide)
                    <tr>
                        <td class="pr-0">{{ $slide->id }}</td>
                        <td width="1%" class="with-img pr-0">
                            @if(isset($slide->id) && Storage::disk('public')->exists('slide_imgs/'.$slide->id.'/img_xs.jpg'))
                                <img src="{{ Storage::disk('public')->url('slide_imgs/'.$slide->id.'/img_xs.jpg') }}" class="img-rounded rounded-circle" />
                            @endif
                        </td>
                        <td>{{ $slide->title }}</td>
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.slides.edit', $slide->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            <a href="{{ route('admin.slides.destroy', $slide->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить слайд?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет добавленных слайдов
        </p>
    @endif

@endsection