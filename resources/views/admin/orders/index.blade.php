@push('css')
    <link href="/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/DataTables/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css" rel="stylesheet" />

    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />

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

    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src=/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script>

        var table = $("#data-table-default").DataTable({
            responsive: true,
            paging: false,
            bInfo : false,
            order: [[ 0, "desc" ]],
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

                var totals = '<div class="pull-left d-flex">';

                    totals += '<div class="h5 mb-0 mr-3 text-dark">Заказов: <b>{{ $orders->count() }}</b></div>';
                    totals += '<div class="h5 mb-0 mr-3 text-dark">Выручка: <b>{{ number_format($total_price) }} ₽</b></div>';
                    totals += '<div class="h5 mb-0 mr-3 text-dark">Комиссия: <b>{!! number_format($commission_calc) . (isset($restaurant) ? ' ₽</b> <small class="text-green">(ставка '.$restaurant->commission.'%)</small>':'') !!}</div>';

                totals += '</div>';


            $("#data-table-default_filter").prepend(totals);


        // $('#data-table-default-checkboxes .form-check-input').on('change', function () {
        //     var column = table.column( $(this).attr('data-column') );
        //     column.visible( ! column.visible() );
        // } );

        $(".input-daterange").datepicker({
            todayHighlight:!0,
            format:'dd-mm-yyyy'
        })
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
    @php
        $list_restaurants = App\Restaurant::all();
    @endphp

    @hasrole('megaroot')
        <div class="btn-group mb-3">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-university"></i>
                @if(isset($restaurant))
                    Ресторан: {{ $restaurant->name }}
                @else
                    Ресторан: Все
                @endif
            </button>
            <div class="dropdown-menu">
                @php
                    $params = request()->except(['restaurant_id']);
                @endphp
                @if(isset($restaurant))
                    <a class="dropdown-item" href="{{ route('admin.home') }}">Все</a>
                @endif
                @foreach($list_restaurants as $rest)
                     @php
                        $params['restaurant_id'] = $rest->id;
                     @endphp
                    <a class="dropdown-item d-block clearfix{{ (isset($restaurant) && $restaurant->id == $rest->id) ? ' bg-grey-lighter' :'' }}" href="{{ qs_url('admin.home', $params) }}">
                        <div class="pull-left mr-3">{{ $rest->name }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    @endrole

    <form class="form-group d-flex" action="{{ route('admin.home') }}" method="get">
        @if($restaurant_id = request('restaurant_id'))
            <input type="hidden" name="restaurant_id" value="{{ $restaurant_id }}">
        @endif
        <div>
            <div class="input-group input-daterange">
                <input type="text" value="{{ request('start') }}" class="form-control input-sm rounded-left" name="start" placeholder="Дата от" />
                <span class="input-group-addon">-</span>
                <input type="text" value="{{ request('end') }}" class="form-control input-sm rounded-right" name="end" placeholder="Дата до" />
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary ml-2">Выбрать</button>
        </div>
    </form>

    @if(count($orders))
        <table id="data-table-default" class="table row-border table-striped orders_table">
            <thead>
            <tr>
                <th width="1%" class="pr-0">ID</th>
                @role('megaroot')
                <th width="1%" class="text-nowrap">Ресторан</th>
                @endrole
                <th width="1%" class="text-nowrap">Сумма</th>
                <th width="1%" class="text-nowrap">Создан</th>
                <th width="1%" class="text-nowrap">Просмотрен</th>
{{--                <th width="1%" class="text-nowrap">Подтвержден</th>--}}
                <th width="1%" data-orderable="false"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="odd gradeX {{ !$order->viewed ? 'not_viewed' : '' }}" id="order_pos_{{ $order->id}}">
                    <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->id}}</td>
                    @role('megaroot')
                        <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->restaurant->name}}</td>
                    @endrole
                    <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->total_price}} ₽</td>
                    <td width="1%" class="f-s-600 text-inverse pr-0">
                        {{ \Carbon\Carbon::createFromTimeString($order->created_at)->diffForHumans() }}
                    </td>
                    <td width="1%" class="f-s-600 text-inverse pr-0 viewed_col">
                        {{ $order->viewed ? 'Да':'Нет' }}
                    </td>
{{--                    <td width="1%" class="f-s-600 text-inverse pr-0 accept_col">--}}
{{--                        {{ $order->accept ? 'Да':'Нет' }}--}}
{{--                    </td>--}}
                    <td width="1%">
                        <div class="width-150">
                            <a href="{{ route('admin.orders.show', $order->id) }}" title="Детали заказа" data-order-id="{{ $order->id }}" class="btn btn-xs m-r-2 btn-primary show_order">Детали заказа</a>
                            @role('megaroot')
                                <a href="{{ route('admin.orders.destroy', $order->id) }}" title="Удалить" data-rm-order="{{ $order->id }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить заказ #{{ $order->id }}?" data-classbtn="danger" data-actionbtn="Удалить" data-type="error" class="btn btn-xs btn-danger"><i class="fas fa-xs fa-fw fa-trash-alt"></i></a>
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
                    $('#order_pos_'+link.data('order-id')+' .viewed_col').text('Да');
                    $('#order_pos_'+link.data('order-id')+' .viewed_col').parent('tr').removeClass('not_viewed');
                    link.html(first_text).removeClass('disabled');

                    modal.find('.modal-title').text('Просмотр заказа #'+link.data('order-id'));
                    modal.find('.modal-body').html(html).promise().done(function(){
                        modal.modal('show');
                        modal.find('.modal-body').attr('data-title', 'Заказ #'+link.data('order-id'));
                    });

                    modal.find('[data-accept]').data('accept', link.data('order-id'));

                }
            });
            return false;
        });

        $(document).on('click', '[data-accept]', function () {
            var link = $(this),
                first_text = link.text(),
                order_id = link.data('accept'),
                modal= $('#show_order');

            link.html('<i class="fas fa-spinner fa-spin"></i> Подтверждаем').addClass('disabled');

            $.ajax({
                type: "POST",
                data: {'order_id':order_id},
                url: '{{ route('admin.orders.accept') }}',
                dataType:"json",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(json) {
                    console.log(json);
                    if(json.success){
                        $('#order_pos_'+order_id+' .accept_col').text('Да');
                        link.html(first_text).removeClass('disabled');
                        modal.modal('hide');
                    }
                }
            });
            return false;
        });

        function rm_order() {
            console.log('123123');
        }

        function print_order(obj, title) {
            var content = $(obj).parents('.modal-content').find('.modal-body');
            var pageTitle = content.data('title'),
                stylesheet = 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
                win = window.open('', 'Print', 'width=700,height=500');
            win.document.write('<html><head><title>Edoshka: ' + pageTitle + '</title>' +
                '<link rel="stylesheet" href="' + stylesheet + '">' +
                '</head><body>' + content[0].outerHTML + '</body></html>');
            win.document.close();

            win.onload = function (){
                win.print();
                win.close();
            };

            return false;
        }

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
                    <button type="button" class="btn btn-secondary" onclick="print_order(this);">Распечатать</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
{{--                    <button type="button" data-accept="" class="btn btn-primary">Подтвердить</button>--}}
                </div>
            </div>
        </div>
    </div>
@endpush
