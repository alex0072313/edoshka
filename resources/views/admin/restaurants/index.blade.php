@extends('layouts.admin')

@section('content')

    <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary btn-lg mb-4">Добавить ресторан</a>

    @if(count($restaurants))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    <th width="1%"></th>
                    <th>Название</th>
                    <th>Город</th>
                    <th>Представитель</th>
                    {{--@role('admin')--}}
                    {{--<th>Владелец</th>--}}
                    {{--@endrole--}}
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($restaurants as $restaurant)
                    <tr>
                        <td class="pr-0">
                            {{ $restaurant->id }}
                        </td>
                        <td width="1%" class="with-img">
                            @if(isset($restaurant->id) && Storage::disk('public')->exists('restaurant_imgs/'.$restaurant->id.'/thumb_xs.jpg'))
                                <img src="{{ Storage::disk('public')->url('restaurant_imgs/'.$restaurant->id.'/thumb_xs.jpg') }}" class="img-rounded rounded-circle" />
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}">{{ $restaurant->name }}</a>
                        </td>
                        <td>
                            @if(auth()->user()->hasRole('megaroot'))
                                <a href="{{ route('admin.towns.edit', $restaurant->town->id) }}">{{ $restaurant->town->name }}</a>
                            @else
                                {{ $restaurant->town->name }}
                            @endif
                        </td>
                        <td>
                            @php
                                $present = $restaurant->present_id ? $restaurant->present : null;
                            @endphp
                            @if($present)
                                <a href="{{ route('admin.presents.edit', $present->id) }}">{{ $present->FullName }}</a>
                            @endif
                        </td>
                        {{--@role('admin')--}}
                        {{--<td><a class="text-green" href="{{ route('user.edit', $category->user->id) }}">{{ $category->user->name }}</a></td>--}}
                        {{--@endrole--}}
                        <td class="with-btn text-center" nowrap>
                            <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            @if(auth()->user()->hasRole('megaroot'))
                                <a href="{{ route('admin.restaurants.destroy', $restaurant->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить ресторан?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @else
        <p class="lead">
            Нет добавленных ресторанов
        </p>
    @endif


@endsection
