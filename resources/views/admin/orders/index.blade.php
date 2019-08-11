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

        {{--var table = $("#data-table-default").DataTable({--}}
        {{--    responsive: true,--}}
        {{--    paging: false,--}}
        {{--    bInfo : false,--}}
        {{--    order: [[ 0, "desc" ]],--}}
        {{--    fixedHeader: {--}}
        {{--        headerOffset: $('#header').outerHeight()--}}
        {{--    },--}}
        {{--    dom: 'Bfrtip',--}}
        {{--    buttons: [--}}
        {{--        // { extend: 'copyHtml5', text: '<i class="fas fa-fw fa-copy"></i> Скопировать в буфер' },--}}
        {{--        // { extend: 'excel', text: '<i class="fas fa-fw fa-table"></i> Сохранить в Excel' },--}}
        {{--        // { extend: 'pdf', text: '<i class="fas fa-fw fa-file-pdf"></i> Сохранить в Pdf' },--}}
        {{--    ],--}}
        {{--    language: {--}}
        {{--        searchPlaceholder: "Поиск по заказам...",--}}
        {{--        search: '',--}}
        {{--        zeroRecords: "Заказов не найдено",--}}

        {{--        // buttons: {--}}
        {{--        //     copyTitle: 'Сохранено в буфер',--}}
        {{--        //     copySuccess: {--}}
        {{--        //         _: '%d обьектов скопированно',--}}
        {{--        //         1: '1 обьект скопирован'--}}
        {{--        //     }--}}
        {{--        // }--}}
        {{--    },--}}
        {{--    //dom: '<"toolbar">frtip'--}}
        {{--});--}}

        {{--var totals = '<div class="pull-left d-flex">';--}}
        {{--    totals += '<div class="h5 mb-0 mr-3 text-dark">Заказов: <b>{{ $orders->count() }}</b></div>';--}}
        {{--    totals += '<div class="h5 mb-0 mr-3 text-dark">Выручка: <b>{{ number_format($total_price) }} ₽</b></div>';--}}
        {{--    totals += '<div class="h5 mb-0 mr-3 text-dark">Комиссия: <b>{!! number_format($commission_calc) . (isset($restaurant) ? ' ₽</b> <small class="text-green">(ставка '.$restaurant->commission.'%)</small>':'') !!}</div>';--}}
        {{--totals += '</div>';--}}

        {{--$("#data-table-default_filter").prepend(totals);--}}


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

    <div class="d-flex">
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

        @if($restaurant_id = request('restaurant_id'))
            <form class="form-group ml-2" action="{{ route('admin.orders_report') }}" method="post">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant_id }}">
                @if($start = request('start'))
                    <input type="hidden" name="start" value="{{ $start }}">
                @endif
                @if($end = request('end'))
                    <input type="hidden" name="end" value="{{ $end }}">
                @endif
                <button type="submit" class="btn btn-success ml-2">Экспорт</button>
            </form>
        @endif
    </div>

    <div class="pull-left d-flex">
        <div class="h5 mb-0 mr-3 text-dark">Заказов: <b>{{ $orders->count() }}</b></div>
        <div class="h5 mb-0 mr-3 text-dark">Выручка: <b>{{ number_format($total_price) }} ₽</b></div>
        <div class="h5 mb-0 mr-3 text-dark">Комиссия: <b>{!! number_format($commission_calc) . (isset($restaurant) ? ' ₽</b> <small class="text-green">(ставка '.$restaurant->commission.'%)</small>':'') !!}</div>
    </div>

    @if(count($orders))
        <div class="table-responsive">
            <table id="data-table-default" class="table row-border table-striped orders_table">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    @role('megaroot')
                    <th width="1%" class="text-nowrap">Ресторан</th>
                    @endrole
                    <th width="1%" class="text-nowrap">Сумма</th>
                    <th width="1%" class="text-nowrap">Покупатель</th>
                    <th width="1%" class="text-nowrap">Создан</th>
                    <th width="1%" class="text-nowrap">Просмотрен</th>
    {{--                <th width="1%" class="text-nowrap">Подтвержден</th>--}}
                    <th width="1%" data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="odd gradeX {{ !$order->viewed ? 'not_viewed' : '' }}" id="order_pos_{{ $order->id}}">

                        <td width="1%" class="f-s-600 text-inverse pr-0 id_item">
                            @include('admin.includes.order_id_item', ['order' => $order])
                        </td>

                        @role('megaroot')
                            <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->restaurant->name}}</td>
                        @endrole
                        <td width="1%" class="f-s-600 text-inverse pr-0 price_item">
                            @include('admin.includes.order_price_item', ['order' => $order])
                        </td>

                        <td width="1%" class="f-s-600 text-inverse pr-0">{{ $order->user->name ?? $order->phone }}</td>

                        <td width="1%" class="f-s-600 text-inverse pr-0">
                            {{ \Carbon\Carbon::createFromTimeString($order->created_at)->diffForHumans() }}
                        </td>
                        <td width="1%" class="f-s-600 text-inverse pr-0 viewed_col">
                            {{ $order->viewed ? 'Да':'Нет' }}
                        </td>
    {{--                    <td width="1%" class="f-s-600 text-inverse pr-0 accept_col">--}}
    {{--                        {{ $order->accept ? 'Да':'Нет' }}--}}
    {{--                    </td>--}}
                        <td width="1%" class="text-right">

                            <div>
                                <a href="#" data-toggle="dropdown" class="btn btn-xs btn-primary" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog mr-1"></i> Действие
                                </a>
                                <div class="dropdown-menu dropdown-menu-right font-weight-bold">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" title="Детали заказа" data-order-id="{{ $order->id }}" class="dropdown-item show_order"><i class="fas fa-file-alt mr-1"></i> Детали заказа</a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="{{ route('admin.orders.change_sum', $order->id) }}" title="Изменить сумму" data-order-id="{{ $order->id }}" class="dropdown-item change_sum_order text-info"><i class="fas fa-ruble-sign mr-1"></i> Изменить сумму</a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="{{ route('admin.orders.cancle', $order->id) }}" title="Отмена заказа" data-order-id="{{ $order->id }}" class="dropdown-item cancle_order text-warning"><i class="fas fa-undo-alt mr-1"></i> Отмена заказа</a>
                                    @role('megaroot')
                                        <div class="dropdown-divider m-0"></div>
                                        <a href="{{ route('admin.orders.destroy', $order->id) }}" title="Удалить" data-rm-order="{{ $order->id }}" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить заказ #{{ $order->id }}?" data-classbtn="danger" data-actionbtn="Удалить" class="dropdown-item text-danger" data-type="error"><i class="fas fa-trash-alt mr-1"></i> Удалить</a>
                                    @endrole
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="lead">
            Нет заказов
        </p>
    @endif

@endsection

@push('js')
    <script>
        //Детали заказа
        $(document).on('click', '.show_order', function () {
            var link = $(this),
                first_text = link.html(),
                modal= $('#order_modal');

            link.html('<i class="fas fa-spinner fa-spin mr-1"></i> Открываем').addClass('disabled');

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

                    modal.find('.modal-content').html(html).promise().done(function(){
                        modal.modal('show');
                    });
                }
            });
            return false;
        });

        //Изменение суммы
        $(document).on('click', '.change_sum_order', function () {
            var link = $(this),
                first_text = link.html(),
                modal= $('#order_modal');

            link.html('<i class="fas fa-spinner fa-spin mr-1"></i> Открываем').addClass('disabled');

            $.ajax({
                type: "GET",
                url: link.attr('href'),
                dataType:"text",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(html) {
                    $('#order_pos_'+link.data('order-id')+' .viewed_col').text('Да');
                    $('#order_pos_'+link.data('order-id')+' .viewed_col').parent('tr').removeClass('not_viewed');
                    link.html(first_text).removeClass('disabled');

                    modal.find('.modal-content').html(html).promise().done(function(){
                        modal.modal('show');
                    });
                }
            });
            return false;
        });

        //Отмена
        $(document).on('click', '.cancle_order', function () {
            var link = $(this),
                first_text = link.html(),
                modal= $('#order_modal');

            link.html('<i class="fas fa-spinner fa-spin mr-1"></i> Открываем').addClass('disabled');

            $.ajax({
                type: "GET",
                url: link.attr('href'),
                dataType:"text",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(html) {
                    $('#order_pos_'+link.data('order-id')+' .viewed_col').text('Да');
                    $('#order_pos_'+link.data('order-id')+' .viewed_col').parent('tr').removeClass('not_viewed');
                    link.html(first_text).removeClass('disabled');

                    modal.find('.modal-content').html(html).promise().done(function(){
                        modal.modal('show');
                    });
                }
            });
            return false;
        });

        $(document).on('click', '[data-accept]', function () {
            var link = $(this),
                first_text = link.text(),
                order_id = link.data('accept'),
                modal= $('#order_modal');

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

        function change_sum_order(btn) {
            var form = $('#change_sum_order'),
                modal= $('#order_modal'),
                btn = $(btn),
                btn_first_html = btn.html(),
                order_id = form.find('[name=\"order_id\"]').val(),
                newsum = form.find('[name=\"newsum\"]').val(),
                newsum_comment = form.find('[name=\"newsum_comment\"]').val();


            btn.html('<i class="fas fa-spinner fa-spin"></i> Подождите').addClass('disabled');

            form.find('.invalid-feedback').remove();
            form.find('input').removeClass('is-invalid');

            $.ajax({
                type: "POST",
                data: {'newsum':newsum, 'newsum_comment':newsum_comment},
                url: form.data('action'),
                dataType:"json",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(json) {

                    btn.html(btn_first_html).removeClass('disabled');

                    if(json.errors){
                        console.log(json.errors);
                        for (var name in json.errors){
                            var input = form.find('[name=\"'+name+'\"]');
                            if(input.length){
                                input.addClass('is-invalid');
                                input.after('<span class="invalid-feedback" role="alert">'+json.errors[name][0]+'</span>');
                            }
                        }
                    }else if(json.success){

                        $('#order_pos_'+order_id+' .price_item').html(json.success.html).promise().done(function(){
                            $('#order_pos_'+order_id+' .price_item [data-toggle="tooltip"]').tooltip();
                        });

                        modal.modal('hide');
                    }
                }
            });

        }

        function cancle_order(btn) {
            var form = $('#cancle_order'),
                modal= $('#order_modal'),
                btn = $(btn),
                btn_first_html = btn.html(),
                order_id = form.find('[name=\"order_id\"]').val(),
                cancle_comment = form.find('[name=\"cancle_comment\"]').val();


            btn.html('<i class="fas fa-spinner fa-spin"></i> Подождите').addClass('disabled');

            form.find('.invalid-feedback').remove();
            form.find('input').removeClass('is-invalid');

            $.ajax({
                type: "POST",
                data: {'cancle_comment':cancle_comment},
                url: form.data('action'),
                dataType:"json",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(json) {

                    btn.html(btn_first_html).removeClass('disabled');

                    if(json.errors){
                        console.log(json.errors);
                        for (var name in json.errors){
                            var input = form.find('[name=\"'+name+'\"]');
                            if(input.length){
                                input.addClass('is-invalid');
                                input.after('<span class="invalid-feedback" role="alert">'+json.errors[name][0]+'</span>');
                            }
                        }
                    }else if(json.success){

                        // $('#order_pos_'+order_id+' .viewed_col').text('Да');
                        // $('#order_pos_'+order_id+' .viewed_col').parent('tr').removeClass('not_viewed');

                        $('#order_pos_'+order_id+' .id_item').html(json.success.html).promise().done(function(){
                            $('#order_pos_'+order_id+' .id_item [data-toggle="tooltip"]').tooltip();
                        });

                        modal.modal('hide');
                    }
                }
            });

        }

    </script>
@endpush

@push('modals')
    <div class="modal" tabindex="-1" role="dialog" id="order_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endpush
