@if($order->cancle)
    <s>{{ $order->id}}</s>
    @if($order->cancle_comment)
        <span class="text-warning" data-toggle="tooltip" data-placement="right" title="{{ $order->cancle_comment }}">
            &nbsp;Отмена <i class="fas fa-info-circle"></i>
        </span>
    @endif

@else
    {{ $order->id}}
@endif
