@extends('layouts.admin')

@section('content')

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-lg mb-4">Добавить категорию</a>

    @if(count($categories))
        <div class="table-responsive">
            <table class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    <th width="1%" class="pr-0"></th>
                    <th>Название</th>
                    <th>Создана в ресторане</th>
                    <th>Алиас</th>
                    <th>В верхнем меню</th>
                    {{--@role('admin')--}}
                    {{--<th>Владелец</th>--}}
                    {{--@endrole--}}
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="pr-0">
                            {{ $category->id }}
                        </td>
                        <td width="1%" class="with-img">
                            @if(isset($category->id) && Storage::disk('public')->exists('category_imgs/'.$category->id.'/img_xs.jpg'))
                                <img src="{{ Storage::disk('public')->url('category_imgs/'.$category->id.'/img_xs.jpg') }}" class="img-rounded rounded-circle" />
                            @endif
                        </td>
                        <td>
                            @if(Auth::user()->can('access', $category))
                                <a href="{{ route('admin.categories.edit', $category->id) }}">
                            @endif
                                {{ $category->name }}
                            @if(Auth::user()->can('access', $category))
                                </a>
                            @endif
                        </td>
                        <td>
                            @php
                                $restaurant = $category->restaurant();
                            @endphp
                            @if(Auth::user()->can('access', $restaurant))
                                <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}">
                            @endif
                                {{ isset($restaurant->name) ? $restaurant->name : ' - ' }}
                            @if(Auth::user()->can('access', $restaurant))
                                </a>
                            @endif
                        </td>
                        <td>
                            {{ $category->alias }}
                        </td>
                        <td>{{ $category->topmenu ? 'Да' : 'Нет' }}</td>
                        {{--@role('admin')--}}
                            {{--<td><a class="text-green" href="{{ route('user.edit', $category->user->id) }}">{{ $category->user->name }}</a></td>--}}
                        {{--@endrole--}}
                        <td class="with-btn text-center" nowrap>
                            @if(Auth::user()->can('access', $category))
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>
                                <a href="{{ route('admin.categories.destroy', $category->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить категорию {{ $category->name }}{{ $category->dishes()->count() ? ' и ее блюда ('.$category->dishes()->count().')':'' }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                            @else
                                <span class="label label-secondary">Нет доступа к изменению</span>
                            @endif
                        </td>
                    </tr>
                    @if(count($category->childs))
                        @php
                            $i = 1;
                        @endphp
                        @include('admin.includes.category_tree_table_item',['childs' => $category->childs, 'i'=>$i])
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

    @else
        <p class="lead">
            Нет добавленных категорий
        </p>
    @endif


@endsection