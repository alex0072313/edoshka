@extends('layouts.admin')

@section('content')

    @if($users)
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th class="pr-0" width="1%">ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Провайдер</th>
                    <th>Заказов</th>
                    <th>Создан</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="pr-0">{{ $user->id }}</td>

                        <td>
                            {{--<a href="{{ route('admin.customers.show', $user->id) }}" class="text-green">{{ $user->name ?: '-' }}</a>--}}
                            {{ $user->name ?: '-' }}
                        </td>

                        <td>{{ $user->email ? $user->email : '-' }}</td>

                        <td>{{ $user->phone ? $user->phone : '-' }}</td>

                        <td>{{ $user->provider ? $user->provider : '-' }}</td>

                        <td>{{ $user->orders()->count() }}</td>
                        <td>{{ $user->created_at }}</td>

                        <td class="with-btn" nowrap>
                            {{--<a href="{{ route('admin.customers.show', $user->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="fas fa-eye"></i></a>--}}
                            <a href="{{ route('admin.customers.destroy', $user->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить покупателя {{ $user->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет покупателей
        </p>
    @endif


@endsection
