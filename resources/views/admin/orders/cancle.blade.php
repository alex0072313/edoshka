<style>
    @media print {
        table{
            font-size: 14px !important;
        }
    }
</style>

<div class="modal-header">
    <h5 class="modal-title">Отмена заказа #{{ $order->id }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" data-title="Отмена заказа #{{ $order->id }}">
    <h4 class="mb-3">Отмена заказа: {{ $order->TotalPrice }} ₽</h4>

    <div data-action="{{ route('admin.orders.cancle', $order->id) }}" class="form-horizontal" id="cancle_order">
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <div class="form-group row">
            <label class="col-form-label col-md-3">Причина отмены</label>
            <div class="col-md-9">
                <textarea name="cancle_comment" class="form-control" rows="4"></textarea>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="cancle_order(this);">Подтвердить отмену</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
</div>



