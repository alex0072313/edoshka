@if($order->newsum)
    <s>{{ $order->OldTotalPrice }}</s>
    <span class="text-info">
        &nbsp;{{ $order->newsum }} ₽
        @if($order->newsum_comment)
            <span data-toggle="tooltip" data-placement="right" title="{{ $order->newsum_comment }}">
                 &nbsp;<i class="fas fa-info-circle"></i>
            </span>
        @endif
    </span>
@else
    {{ $order->OldTotalPrice }} ₽
@endif

@if($order->commission['commission_sum'])
    &nbsp;<small class="text-green">({{ $order->commission['commission_percent'] .'%, '. $order->commission['commission_sum'] }} ₽)</small>
@endif
