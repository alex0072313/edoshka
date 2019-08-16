@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.kitchens.create') }}" class="btn btn-primary btn-lg mb-4">Добавить кухню</a>
    @if(count($kitchens))
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
                @foreach($kitchens as $kitchen)
                    <tr>
                        <td class="pr-0">{{ $kitchen->id }}</td>
                        <td><a href="{{ route('admin.kitchens.edit', $kitchen->id) }}">{{ $kitchen->name }}</a></td>
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.kitchens.edit', $kitchen->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            <a href="{{ route('admin.kitchens.destroy', $kitchen->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить кухню {{ $kitchen->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет добавленных кухонь
        </p>
    @endif

@endsection
