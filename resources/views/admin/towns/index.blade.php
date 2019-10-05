@extends('layouts.admin')

@section('content')
    <a href="{{ route('admin.towns.create') }}" class="btn btn-primary btn-lg mb-4">Добавить город</a>
    @if(count($towns))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    <th>Название</th>
                    <th>Название 2</th>
                    <th>Название 3</th>
                    <th>Алиас</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($towns as $town)
                    <tr>
                        <td class="pr-0">{{ $town->id }}</td>
                        <td><a href="{{ route('admin.towns.edit', $town->id) }}">{{ $town->name }}</a></td>
                        <td>{{ $town->name2 }}</td>
                        <td>{{ $town->name3 }}</td>
                        <td>{{ $town->alias }}</td>
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.towns.edit', $town->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            <a href="{{ route('admin.towns.destroy', $town->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить город {{ $town->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет добавленных городов
        </p>
    @endif

@endsection
