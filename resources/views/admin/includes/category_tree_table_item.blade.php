@foreach($childs as $category)
    <tr>
        <td>
            @for($_i = 0; $_i < $i; $_i++)
                &nbsp;&nbsp;
            @endfor
            - {{ $category->name }}</td>
        {{--@role('megaroot')--}}
        {{--<td><a class="text-green" href="{{ route('admin.user.edit', $category->user->id) }}">{{ $category->user->name }}</a></td>--}}
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
    @if($category->childs->count)
        @php
            $i = $i+1;
        @endphp
        @include('admin.includes.category_tree_table_item',['childs' => $category->childs, 'i'=>$i])
    @endif
@endforeach
