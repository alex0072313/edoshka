@extends('layouts.admin')

@section('content')
    {{--<a href="{{ route('admin.helpmsgs.create') }}" class="btn btn-primary btn-lg mb-4">Добавить поле</a>--}}
    @if(count($helpmsgs))
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
                @foreach($helpmsgs as $helpmsg)
                    <tr>
                        <td class="pr-0">{{ $helpmsg->id }}</td>
                        <td><a href="{{ route('admin.helpmsgs.edit', ['helpmsg_name' => $helpmsg->name]) }}">{{ $helpmsg->name }}</a></td>
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.helpmsgs.edit', ['name' => $helpmsg->name, 'page' => $helpmsg->page]) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            {{--<a href="{{ route('admin.helpmsgs.destroy', ['helpmsg_name' => $helpmsg->name]) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить поле {{ $helpmsg->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет добавленных полей
        </p>
    @endif

@endsection