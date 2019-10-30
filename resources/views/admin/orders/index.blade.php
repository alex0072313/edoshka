@push('css')
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src=/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
        $(".input-daterange").datepicker({
            todayHighlight:!0,
            format:'dd-mm-yyyy'
        })
    </script>
@endpush

@extends('layouts.admin')

@section('content')

    @if(isset($restaurants))
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
                @foreach($restaurants as $rest)
                     @php
                        $params['restaurant_id'] = $rest->id;
                     @endphp
                    <a class="dropdown-item d-block clearfix{{ (isset($restaurant) && $restaurant->id == $rest->id) ? ' bg-grey-lighter' :'' }}" href="{{ qs_url('admin.home', $params) }}">
                        <div class="pull-left mr-3">{{ $rest->name }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

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

    <div class="pull-left d-flex" id="orders_totals">
        @include('admin.includes.orders_totals', [
        'total_orders' => $total_orders,
        'total_cancle' => $total_cancle,
        'total_newsum' => $total_newsum,
        'total_price' => $total_price,
        'commission_sum' => $commission_sum,
        'commission' => isset($commission) ? $commission : null,
        ])
    </div>

    @if(count($orders))
        <div class="table-responsive">
            <table id="data-table-default" class="table row-border table-striped orders_table">
                <thead>
                <tr>
                    <th width="1%" class="pr-0">ID</th>
                    @if(isset($restaurants))
                        <th width="1%" class="text-nowrap">Ресторан</th>
                    @endif
                    <th width="1%" class="text-nowrap">Сумма</th>
                    <th width="1%" class="text-nowrap">Покупатель</th>
                    <th width="1%" class="text-nowrap">Создан</th>
                    <th width="1%" class="text-nowrap">Просмотрен</th>
                    <th width="1%" data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    @include('admin.includes.order_tr_item', ['order' => $order])
                @endforeach
                </tbody>
            </table>
        </div>
        @if(count($orders) < $total_orders)
            <div class="py-3 orders_load_more text-center">
                <button class="btn btn-primary">Загрузить еще</button>
            </div>
        @endif
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
                    update_totals();
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
                    update_totals();

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
        //Подгрузка
        $(document).on('click', '.orders_load_more button', function () {
            var btn = $(this),
                box_btn = btn.parent('.orders_load_more'),
                first_text = btn.html(),
                orders_tbody = $('#data-table-default tbody'),
                cnt_orders = $('#data-table-default tbody tr').length;

            if(btn.hasClass('disabled')) return false;

            btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Подождите').addClass('disabled');

            var data = {!! request()->all() ? json_encode(request()->all()) : '{}' !!};

            data.ot = cnt_orders;

            $.ajax({
                type: "POST",
                data:data,
                url: '{{ route('admin.orders.append') }}',
                dataType:"json",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(json) {
                    console.log(json);
                    btn.html(first_text).removeClass('disabled');
                    orders_tbody.append(json.html).promise().done(function () {
                        if(parseInt($('#cnt_total_orders').text()) <= ($('#data-table-default tbody tr').length)){
                            box_btn.remove();
                        }
                    });
                }
            });

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
                        update_totals();
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
                        update_totals();
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

        function update_totals() {

            var data = {!! request()->all() ? json_encode(request()->all()) : '{}' !!};

            $.ajax({
                type: "POST",
                data:data,
                url: '{{ route('admin.orders.get_totals') }}',
                dataType:"json",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(json) {
                    console.log(json);
                    $('#orders_totals').html(json.html);
                }
            });
        }
    </script>
@endpush

@push('modals')
    <div class="modal" tabindex="-1" role="dialog" id="order_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content"></div>
        </div>
    </div>
@endpush
