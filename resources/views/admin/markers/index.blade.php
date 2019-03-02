@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.markers.create') }}" class="btn btn-primary btn-lg mb-4">Добавить маркер</a>
    @if(count($markers))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    <th>Название</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($markers as $marker)
                    <tr>
                        <td class="pr-0">{{ $marker->id }}</td>
                        <td><a href="{{ route('admin.markers.edit', $marker->id) }}">{{ $marker->name }}</a></td>
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.markers.edit', $marker->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            <a href="{{ route('admin.markers.destroy', $marker->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить маркер {{ $marker->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет добавленных маркеров
        </p>
    @endif

@endsection