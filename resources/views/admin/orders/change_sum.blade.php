<style>
    @media print {
        table{
            font-size: 14px !important;
        }
    }
</style>

<div class="modal-header">
    <h5 class="modal-title">Изменение суммы заказа #{{ $order->id }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" data-title="Изменение суммы заказа #{{ $order->id }}">
    <h4 class="mb-3">Текущая сумма заказа: {{ $order->TotalPrice }} ₽</h4>

    <div data-action="{{ route('admin.orders.change_sum', $order->id) }}" class="form-horizontal" id="change_sum_order">
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <div class="form-group row">
            <label class="col-form-label col-md-3">Новая сумма</label>
            <div class="col-md-9">
                <input type="number" name="newsum" min="0" value="" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-md-3">Причина изменения суммы</label>
            <div class="col-md-9">
                <textarea name="newsum_comment" class="form-control" rows="4"></textarea>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="change_sum_order(this);">Изменить сумму</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
</div>



