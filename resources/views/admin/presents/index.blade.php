@extends('layouts.admin')

@section('content')

    <a href="{{ route('admin.presents.create') }}" class="btn btn-primary btn-lg mb-4">Добавить представителя</a>

    @if($users->count())
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th class="pr-0" width="1%">ID</th>
                    <th></th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Кол-во ресторанов</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="pr-0">{{ $user->id }}</td>
                        <td class="with-img width-40 pr-0">
                            @if(Storage::disk('public')->exists('user_imgs/'.$user->id.'/thumb_xs.jpg'))
                                <a href="{{ route('admin.presents.edit', $user->id) }}" class="text-green">
                                    <img src="{{ Storage::disk('public')->url('user_imgs/'.$user->id.'/thumb_xs.jpg') }}"
                                         class="rounded-circle"/>
                                </a>
                            @endif
                        </td>
                        <td><a href="{{ route('admin.presents.edit', $user->id) }}" class="text-green">{!! ($user->lastname ? $user->lastname.'&nbsp' : '') . $user->name !!}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            {{ $user->restaurants->count() }}
                        </td>
                        <td class="with-btn" nowrap>
                            <a href="{{ route('admin.presents.edit', $user->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            <a href="{{ route('admin.presents.destroy', $user->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить представителя {{ $user->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет добавленных представителей
        </p>
    @endif


@endsection
