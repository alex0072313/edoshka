@extends('layouts.admin')

@section('content')

    <a href="{{ route('admin.categories.create') }}" class="btn btn-green btn-lg mb-4"><i class="fas fa-fw fa-folder-open"></i> Добавить категорию</a>

    @if($categories)
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Категории блюд</h4>
            </div>

            <!-- begin panel-body -->
            <div class="panel-body">
                <!-- begin table-responsive -->
                <div class="table-responsive">
                    <table class="table table-striped m-b-0">
                        <thead>
                        <tr>
                            <th>Название</th>
                            {{--@role('admin')--}}
                            {{--<th>Владелец</th>--}}
                            {{--@endrole--}}
                            <th width="1%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                {{--@role('admin')--}}
                                    {{--<td><a class="text-green" href="{{ route('user.edit', $category->user->id) }}">{{ $category->user->name }}</a></td>--}}
                                {{--@endrole--}}
                                <td class="with-btn text-center" nowrap>
                                    @if(Auth::user()->can('access', $category))
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-xs m-r-2 btn-green"><i class="far fa-xs fa-fw fa-edit"></i></a>
                                        <a href="{{ route('admin.categories.destroy', $category->id) }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить категорию {{ $category->name }}{{ $category->childs()->count() ? ' и ее потомков':'' }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
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
                <!-- end table-responsive -->
            </div>
            <!-- end panel-body -->
        </div>
    @else
        <p class="lead">
            Нет добавленных категорий
        </p>
    @endif


@endsection