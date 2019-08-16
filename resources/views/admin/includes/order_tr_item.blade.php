<tr class="odd gradeX {{ !$order->viewed ? 'not_viewed' : '' }}" id="order_pos_{{ $order->id}}">
    <td width="1%" class="f-s-600 text-inverse pr-0 id_item">
        @include('admin.includes.order_id_item', ['order' => $order])
    </td>
    @if($is_megaroot)
        <td width="1%" class="f-s-600 text-inverse pr-0">{{ isset($order->restaurant->name) ? $order->restaurant->name : '' }}</td>
    @endif
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
                @if($is_megaroot)
                    <div class="dropdown-divider m-0"></div>
                    <a href="{{ route('admin.orders.destroy', $order->id) }}" title="Удалить" data-rm-order="{{ $order->id }}" data-aftersuccess="update_totals" data-click="swal-warning" data-title="Подтвердите действие" data-text="Удалить заказ #{{ $order->id }}?" data-classbtn="danger" data-actionbtn="Удалить" class="dropdown-item text-danger" data-type="error"><i class="fas fa-trash-alt mr-1"></i> Удалить</a>
                @endif
            </div>
        </div>
    </td>
</tr>
