@extends('layouts.admin')

@section('content')

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-lg mb-4">Добавить категорию</a>

        @if($categories->count())
            <div class="btn-group mb-4 ml-2">
                @hasrole('megaroot|root')
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-folder-open"></i>
                    @if(isset($restaurant->id))
                        Сортировка: {{ $restaurant->name }}
                    @else
                        Сортировка: Все
                    @endif
                </button>
                <div class="dropdown-menu">
                    @php
                        $params = request()->all();
                    @endphp
                    <a class="dropdown-item d-block" href="{{ route('admin.categories.index') }}" >
                        Все
                    </a>
                    @foreach($restaurants as $rest)
                        @php
                            $params['restaurant_id'] = $rest->id;
                        @endphp
                        <a class="dropdown-item d-block{{ (isset($restaurant->id) && $restaurant->id == $rest->id) ? ' bg-grey-lighter' :'' }}" href="{{ qs_url('admin.categories.index', $params) }}" >
                            {{ $rest->name }}
                        </a>
                    @endforeach
                </div>
                @endrole
                @if(isset($restaurant->id) && $restaurant->categories_sort)
                    <a href="{{ route('admin.categories.clearsort', $restaurant->id) }}" class="btn btn-danger ml-2 rounded-left" data-click="swal-warning" data-title="Подтвердите действие" data-text="Восстановить сотировку по умолчанию?" data-classbtn="danger" data-actionbtn="Да" data-type="warning">Сбросить сортировку</a>
                @endif
            </div>
        @endif

    @if(isset($restaurant->id))
        <div class="alert alert-info fade show">
            Сорировку категорий можно изменить перетаскиванием.
        </div>
    @endif

{{--    @if($categories->count())--}}
{{--        <div class="table-responsive">--}}
{{--            <table class="table table-striped m-b-0">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th width="1%" class="pr-0">ID</th>--}}
{{--                    <th width="1%" class="pr-0"></th>--}}
{{--                    <th>Название</th>--}}
{{--                    <th>Создана в ресторане</th>--}}
{{--                    <th>Алиас</th>--}}
{{--                    <th>В верхнем меню</th>--}}
{{--                    @role('admin')--}}
{{--                    <th>Владелец</th>--}}
{{--                    @endrole--}}
{{--                    <th width="1%"></th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody id="sort_items">--}}
{{--                @foreach($categories as $category)--}}
{{--                    <tr data-id="{{$category->id}}">--}}
{{--                        <td class="pr-0">--}}
{{--                            {{ $category->id }}--}}
{{--                        </td>--}}
{{--                        <td width="1%" class="with-img">--}}
{{--                            @if(isset($category->id) && Storage::disk('public')->exists('category_imgs/'.$category->id.'/img_xs.jpg'))--}}
{{--                                <img src="{{ Storage::disk('public')->url('category_imgs/'.$category->id.'/img_xs.jpg') }}" class="img-rounded rounded-circle" />--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            @if(Auth::user()->can('access', $category))--}}
{{--                                <a href="{{ route('admin.categories.edit', $category->id) }}">--}}
{{--                            @endif--}}
{{--                                {{ $category->name }}--}}
{{--                            @if(Auth::user()->can('access', $category))--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            @php--}}
{{--                                $rest = $category->restaurant();--}}
{{--                            @endphp--}}
{{--                            @if(!is_null($rest))--}}
{{--                                @if(Auth::user()->can('access', $rest))--}}
{{--                                    <a href="{{ route('admin.restaurants.edit', $rest->id) }}">--}}
{{--                                @endif--}}
{{--                                    {{ isset($rest->name) ? $rest->name : ' - ' }}--}}
{{--                                @if(Auth::user()->can('access', $rest))--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            @else--}}
{{--                                Для всех--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            {{ $category->alias }}--}}
{{--                        </td>--}}
{{--                        <td>{{ $category->topmenu ? 'Да' : 'Нет' }}</td>--}}
{{--                        @role('admin')--}}
{{--                            <td><a class="text-green" href="{{ route('user.edit', $category->user->id) }}">{{ $category->user->name }}</a></td>--}}
{{--                        @endrole--}}
{{--                        <td class="with-btn text-center" nowrap>--}}
{{--                            @if(Auth::user()->can('access', $category))--}}
{{--                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-xs m-r-2 btn-primary"><i class="far fa-xs fa-fw fa-edit"></i></a>--}}
{{--                                <a href="{{ route('admin.categories.destroy', $category->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить категорию {{ $category->name }}{{ !is_null($category->dishes()) && $category->dishes()->count() ? ' и ее блюда ('.$category->dishes()->count().')':'' }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>--}}
{{--                            @else--}}
{{--                                <span class="label label-secondary">Нет доступа к изменению</span>--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    @if($category->childs->count())--}}
{{--                        @php--}}
{{--                            $i = 1;--}}
{{--                        @endphp--}}
{{--                        @include('admin.includes.category_tree_table_item',['childs' => $category->childs, 'i'=>$i])--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}

{{--    @else--}}
{{--        <p class="lead">--}}
{{--            Нет добавленных категорий--}}
{{--        </p>--}}
{{--    @endif--}}

@endsection

@if(isset($restaurant->id))
    @push('js')
        <script src="/assets/js/sortablejs/Sortable.min.js"></script>
        <script>
            var el = document.getElementById('sort_items');
            var sortable = Sortable.create(el, {
                ghostClass: 'sortghost',
                onUpdate: function () {
                    var ids = [];
                    $('#sort_items > tr').each(function () {
                        ids.push(parseInt($(this).data('id')));
                    });

                    $.ajax({
                        url: '{{ route('admin.categories.sort') }}',
                        dataType: 'json',
                        data: { ids:ids, restaurant_id:{{ $restaurant->id }} },
                        type: 'post',
                        success:function(response){
                            console.log(response);
                        },
                    });
                }
            });
        </script>
    @endpush
@endif

