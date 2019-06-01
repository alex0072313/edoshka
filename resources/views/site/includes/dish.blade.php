<div class="shop_pos_item p-2" data-product-id="{{ $dish->id }}" id="dish{{ $dish->id }}">
	<div class="image mb-1">
		@if($dish->all_markers)
			<div class="badges d-flex align-items-start flex-column">
				@foreach($dish->all_markers as $marker)
					<div class="{!! $marker->css_class !!}">{!! $marker->content !!}</div>
				@endforeach
			</div>
		@endif
		@if(Storage::disk('public')->exists('dish_imgs/'.$dish->id.'/img_m.jpg'))
			{{--<img class="lazy" data-src="{{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_m.jpg') }}" width="165" height="160">--}}
			<div class="lazy" data-bg="url({{ Storage::disk('public')->url('dish_imgs/'.$dish->id.'/img_m.jpg') }})"></div>
		@endif
	</div>
	<div class="title font-weight-bold">
		{{ $dish->name }}
	</div>
	<div class="params text-secondary">
		<small class="text-nowrap">{{ $dish->description }}</small>
	</div>
	<div class="price d-sm-flex justify-content-between">
		<div class="h4 mb-1 mb-sm-0">

			@if($dish->new_price)
				<small class="old">{{ $dish->price }}</small>
				<span class="new">{{ $dish->new_price }} &#8381;</span>
			@else
				{{ $dish->price }} &#8381;
			@endif
		</div>
		<div>
			<button class="btn btn-success btn-sm add_to_cart" data-dish-id="{{ $dish->id }}">В корзину</button>
		</div>
	</div>
</div>
