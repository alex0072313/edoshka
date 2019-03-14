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
            "order": [[ 1, "desc" ]],
            fixedHeader: {
                headerOffset: $('#header').outerHeight()
            },
            dom: 'Bfrtip',
            buttons: [
                // { extend: 'copyHtml5', text: '<i class="fas fa-fw fa-copy"></i> Скопировать в буфер' },
                // { extend: 'excel', text: '<i class="fas fa-fw fa-table"></i> Сохранить в Excel' },
                // { extend: 'pdf', text: '<i class="fas fa-fw fa-file-pdf"></i> Сохранить в Pdf' },
            ],
            language: {
                searchPlaceholder: "Поиск по заказам...",
                search: '',
                zeroRecords: "Заказов не найдено",

                // buttons: {
                //     copyTitle: 'Сохранено в буфер',
                //     copySuccess: {
                //         _: '%d обьектов скопированно',
                //         1: '1 обьект скопирован'
                //     }
                // }
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
    {{--@php--}}
        {{--$list_categories = App\Category::allToAccess(true);--}}
    {{--@endphp--}}
    {{--@if($list_categories->count())--}}
        {{--<div class="btn-group mb-4 ml-2">--}}
            {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                {{--<i class="fas fa-fw fa-folder-open"></i>--}}
                {{--@if(isset($category))--}}
                    {{--Категория блюд: {{ $category->name }}--}}
                {{--@else--}}
                    {{--Категория блюд: Все--}}
                {{--@endif--}}
            {{--</button>--}}
            {{--<div class="dropdown-menu">--}}
                {{--@if(isset($category))--}}
                    {{--<a class="dropdown-item" href="{{ route('admin.orders.index') }}">Все</a>--}}
                {{--@endif--}}
                {{--@foreach($list_categories as $cat)--}}
                    {{--<a class="dropdown-item d-block clearfix{{ (isset($category) && $category->id == $cat->id) ? ' bg-grey-lighter' :'' }}" href="{{ route('admin.orders.index', 'category_'.$cat->id) }}">--}}
                        {{--<div class="pull-left mr-3">{{ $cat->name }}</div>--}}
                        {{--@if($category_by_orders[$cat->id])--}}
                            {{--<div class="font-weight-bold text-primary pull-right">{{ $category_by_orders[$cat->id] }}</div>--}}
                        {{--@endif--}}
                    {{--</a>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endif--}}

    {{--<a href="{{ isset($category) ? route('fields.index', 'category_'.$category->id) : route('fields.index') }}" class="btn btn-default mb-4 ml-2"><i class="fas fa-fw fa-server"></i> Управение доп. полями</a>--}}

    @if(count($orders))
        <table id="data-table-default" class="table row-border table-striped">
            <thead>
            <tr>
                <th width="1%" class="pr-0">ID</th>
                @role('megaroot')
                <th width="1%" class="text-nowrap">Ресторан</th>
                @endrole
                <th width="1%" class="text-nowrap">Сумма</th>
                <th width="1%" class="text-nowrap">Кол-во блюд</th>
                <th width="1%" class="text-nowrap">Телефон</th>
                <th class="text-nowrap">Адрес</th>
                <th width="1%" class="text-nowrap">Email</th>
                <th width="1%" class="text-nowrap">Создан</th>
                <th width="1%" data-orderable="false"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="odd gradeX">
                    <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->id}}</td>
                    @role('megaroot')
                        <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->restaurant->name}}</td>
                    @endrole
                    <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->price}}</td>
                    <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->quantity}}</td>
                    <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->phone}}</td>

                    @php
                        $address = [];

                        if($order->home){
                            $address[] = $order->home;
                        }
                        if($order->street){
                            $address[] = $order->street;
                        }

                        $address = implode(', ', $address);
                    @endphp

                    <td width="1%" class="f-s-600 text-inverse pr-0">{{ $address }}</td>
                    <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->email}}</td>
                    <td width="1%" class="f-s-600 text-inverse pr-0">
                        {{ \Carbon\Carbon::createFromTimeString($order->created_at)->diffForHumans() }}
                    </td>
                    <td width="1%">
                        <div class="width-150">
                            <a href="{{ route('admin.orders.show', $order->id) }}" title="Детали заказа" data-order-id="{{ $order->id }}" class="btn btn-xs m-r-2 btn-primary show_order">Детали заказа</a>
                            @role('megaroot')
                                <a href="{{ route('admin.orders.destroy', $order->id) }}" title="Удалить" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить заказ #{{ $order->id }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
                            @endrole
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="lead">
            Нет заказов
        </p>
    @endif

@endsection

@push('js')
    <script>
        $(document).on('click', '.show_order', function () {
            var link = $(this),
                first_text = link.text(),
                modal= $('#show_order');

            link.html('<i class="fas fa-spinner fa-spin"></i> Открываем').addClass('disabled');

            $.ajax({
                type: "GET",
                url: link.attr('href'),
                dataType:"text",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(html) {
                    console.log(html);

                    link.html(first_text).removeClass('disabled');

                    modal.find('.modal-title').text('Просмотр заказа #'+link.data('order-id'));
                    modal.find('.modal-body').html(html).promise().done(function(){
                        modal.modal('show');
                    });

                }
            });
            return false;
        });
    </script>
@endpush

@push('modals')
    <div class="modal" tabindex="-1" role="dialog" id="show_order">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>
@endpush
