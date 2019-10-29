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

    <div class="d-flex">
        <form class="form-group d-flex" action="{{ route('admin.customers.index') }}" method="get">
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
    </div>

    <div class="pull-left d-flex" id="totals">
        <div class="h5 mb-0 mr-3 text-dark">
            Всего покупателей: <b>{{ $total }}</b>
        </div>
    </div>
    @if($users)
        <div class="table-responsive">
            <table id="result_table" class="table table-striped m-b-0">
                <thead>
                <tr>
                    <th class="pr-0" width="1%">ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Провайдер</th>
                    <th>Заказов</th>
                    <th>Сумма покупок</th>
{{--                    <th>Баллов</th>--}}
                    <th>Создан</th>
                    <th width="1%"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    @include('admin.includes.customer_tr_item', ['user' => $user])
                @endforeach
                </tbody>
            </table>
        </div>
        @if(count($users) < $total)
            <div class="py-3 load_more text-center">
                <button class="btn btn-primary">Загрузить еще</button>
            </div>
        @endif
    @else
        <p class="lead">
            Нет покупателей
        </p>
    @endif


@endsection
@push('js')
    <script>
        //Подгрузка
        $(document).on('click', '.load_more button', function () {
            var btn = $(this),
                box_btn = btn.parent('.load_more'),
                first_text = btn.html(),
                tbody = $('#result_table tbody'),
                cnt = $('#result_table tbody tr').length;

            if(btn.hasClass('disabled')) return false;

            btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Подождите').addClass('disabled');

            var data = {!! request()->all() ? json_encode(request()->all()) : '{}' !!};

            data.ot = cnt;

            $.ajax({
                type: "POST",
                data:data,
                url: '{{ route('admin.customers.append') }}',
                dataType:"json",
                error: function(xhr) {
                    console.log('Ошибка!'+xhr.status+' '+xhr.statusText);
                },
                success: function(json) {
                    console.log(json);
                    btn.html(first_text).removeClass('disabled');
                    tbody.append(json.html).promise().done(function () {
                        if(parseInt($('#cnt_total').text()) <= ($('#result_table tbody tr').length)){
                            box_btn.remove();
                        }
                    });
                }
            });

        });
    </script>
@endpush
