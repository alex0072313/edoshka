@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.districts.create') }}" class="btn btn-primary btn-lg mb-4">Добавить район</a>
    @if(count($districts))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                    <tr>
                        <th width="1%" class="pr-0">ID</th>
                        <th>Название</th>
                        <th>Название 2</th>
                        <th>Название 3</th>
                        <th>Алиас</th>
                        <th>Город</th>
                        <th width="1%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($districts as $district)
                        <tr>
                            <td class="pr-0">{{ $district->id }}</td>
                            <td><a href="{{ route('admin.districts.edit', $district->id) }}">{{ $district->name }}</a></td>
                            <td>{{ $district->name2 }}</td>
                            <td>{{ $district->name3 }}</td>
                            <td>{{ $district->alias }}</td>
                            <td>{{ $district->town_name }}</td>
                            <td class="with-btn text-center" nowrap>
                                <a href="{{ route('admin.districts.edit', $district->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                                <a href="{{ route('admin.districts.destroy', $district->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить район {{ $district->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет добавленных районов
        </p>
    @endif
@endsection
