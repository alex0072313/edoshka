@push('css')
    <link href="/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/DataTables/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"></script>
    <script>

        var table = $("#data-table-default").DataTable({
            responsive: true,
            paging: false,
            bInfo : false,
            fixedHeader: {
                headerOffset: $('#header').outerHeight()
            },
            dom: 'Bfrtip',
            buttons: [
                { extend: 'copyHtml5', text: '<i class="fas fa-fw fa-copy"></i> Скопировать в буфер' },
                { extend: 'excel', text: '<i class="fas fa-fw fa-table"></i> Сохранить в Excel' },
                { extend: 'pdf', text: '<i class="fas fa-fw fa-file-pdf"></i> Сохранить в Pdf' },
            ],
            language: {
                searchPlaceholder: "Поиск по обьектам...",
                search: '',
                zeroRecords: "Обьектов не найдено",

                buttons: {
                    copyTitle: 'Сохранено в буфер',
                    copySuccess: {
                        _: '%d обьектов скопированно',
                        1: '1 обьект скопирован'
                    }
                }
            },
            //dom: '<"toolbar">frtip'
        });

                {{--@if(isset($fields_names))--}}
        {{--var checkboxes = '<div id="data-table-default-checkboxes" class="clearfix pt-2">';--}}
        {{--checkboxes += '<div class="pull-left clearfix bg-grey-transparent-1 rounded px-2 pb-2">';--}}
        {{--@foreach($fields_names as $field_id => $field_name)--}}
            {{--checkboxes += '<div class="checkbox checkbox-css pull-left{{ $loop->index ? ' ml-3' :'' }}">' +--}}
            {{--'<input class="form-check-input" type="checkbox" data-column="{{ $loop->index + 4 }}" name="remember" checked id="table_filter_{{ $field_id }}" >' +--}}
            {{--'<label for="table_filter_{{ $field_id }}">' +--}}
            {{--'{{ $field_name }}' +--}}
            {{--'</label>' +--}}
            {{--'</div>';--}}
        {{--@endforeach--}}

            {{--checkboxes += '</div>';--}}
        {{--checkboxes += '</div>';--}}

        {{--$("#data-table-default").before(checkboxes);--}}
        {{--@endif--}}

        // $('#data-table-default-checkboxes .form-check-input').on('change', function () {
        //     var column = table.column( $(this).attr('data-column') );
        //     column.visible( ! column.visible() );
        // } );

    </script>
@endpush

@extends('layouts.admin')

@section('content')

    <a href="{{ isset($category) ? route('admin.dishes.create_in_cat', 'category_'.$category->id) : route('admin.dishes.create') }}" class="btn btn-primary btn-lg mb-4"><i class="fas mr-1 fa-concierge-bell"></i> Добавить блюдо</a>

    @php
        $list_categories = App\Category::allToAccess(true);
    @endphp

    @if($list_categories->count())
        <div class="btn-group mb-4 ml-2">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder-open"></i>
                @if(isset($category))
                    Категория блюд: {{ $category->name }}
                @else
                    Категория блюд: Все
                @endif
            </button>
            <div class="dropdown-menu">
                @if(isset($category))
                    <a class="dropdown-item" href="{{ route('admin.dishes.index') }}">Все</a>
                @endif
                @foreach($list_categories as $cat)
                    <a class="dropdown-item d-block clearfix{{ (isset($category) && $category->id == $cat->id) ? ' bg-grey-lighter' :'' }}" href="{{ route('admin.dishes.index', 'category_'.$cat->id) }}">
                        <div class="pull-left mr-3">{{ $cat->name }}</div>
                        @if($category_by_dishes[$cat->id])
                            <div class="font-weight-bold text-green pull-right">{{ $category_by_dishes[$cat->id] }}</div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{--<a href="{{ isset($category) ? route('fields.index', 'category_'.$category->id) : route('fields.index') }}" class="btn btn-default mb-4 ml-2"><i class="fas fa-fw fa-server"></i> Управение доп. полями</a>--}}

    {{--<div class="d-block mb-4 d-flex">--}}
    {{--<div class="px-2 py-2 ">--}}
    {{--<i class="fas fa-fw fa-folder-open"></i> Категория обьектов:--}}
    {{--</div>--}}
    {{--<div class="btn-group" role="group" aria-label="Категории обьектов">--}}
    {{--@foreach($category_by_owners as $cat_name => $owners_cnt)--}}
    {{--<a href="#" class="btn btn-default"> @if($owners_cnt)<span class="label label-theme">{{ $owners_cnt }}</span> @endif{{ $cat_name }}</a>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}

    @if(count($dishes))
        <table id="data-table-default" class="table row-border table-striped">
            <thead>
            <tr>
                <th width="1%">ID</th>
                <th width="1%" data-orderable="false"></th>
                <th class="text-nowrap">Название</th>
                <th class="text-nowrap">Категория</th>
                {{--@foreach($fields_names as $field_id => $field_name)--}}
                    {{--<th class="text-nowrap">{{ $field_name }}</th>--}}
                {{--@endforeach--}}
                <th width="1%" data-orderable="false"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($dishes as $dish)
                <tr class="odd gradeX">
                    <td width="1%" class="f-s-600 text-inverse">{{ $dish->id}}</td>
                    <td width="1%" class="with-img">
                        <img src="{{ $dish->thumb }}" class="img-rounded rounded-circle" />
                    </td>
                    <td><a href="{{ route('admin.dishes.edit', 'owner_'.$dish->id) }}" class="text-green">{{ $dish->name }}</a></td>
                    <td><a href="{{ route('admin.dishes.index', 'category_'.$dish->category->id) }}" class="text-green">{{ $dish->category->name }}</a></td>

                    {{--@foreach($fields_names as $field_id => $field_name)--}}
                        {{--<td width="1%">--}}
                            {{--@if(isset($dish->fields_cont[$field_id]))--}}
                                {{--{{ $dish->fields_cont[$field_id] }}--}}
                            {{--@else--}}
                                {{-----}}
                            {{--@endif--}}
                        {{--</td>--}}
                    {{--@endforeach--}}

                    <td width="1%">
                        <div class="width-60">
                            <a href="{{ route('admin.dishes.edit', $dish->id) }}" title="Изменить" class="btn btn-xs m-r-2 btn-green"><i class="far fa-xs fa-fw fa-edit"></i></a>
                            <a href="{{ route('admin.dishes.destroy', 'owner_'.$dish->id) }}" title="Удалить" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить обьект {{ $dish->name }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="lead">
            Нет добавленных блюд
        </p>
    @endif


@endsection