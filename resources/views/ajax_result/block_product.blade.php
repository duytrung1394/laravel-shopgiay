
	<div class="row filter-tag">
		<!-- Tag-filter -->
		@if(count($brands) > 0)
			@foreach($brands as $brand)
				<a class="remove-tag" data-tag='filter-brand-{{$brand->id}}'>{{$brand->name}} <i class="fa fa-times" aria-hidden="true"></i></a>
			@endforeach
		@endif
		@if(count($sizes) > 0)
			@foreach($sizes as $size)
				<a class="remove-tag" data-tag='filter-size-{{$size->id}}'>{{$size->name}} <i class="fa fa-times" aria-hidden="true"></i></a>
			@endforeach
		@endif

		@if(count($price_list) > 0)
			@foreach($price_list as $price_node)
				<a class="remove-tag" data-tag="filter-price-{{ $price_node['price_min'] }}-{{ $price_node['price_max'] }}">{{ number_format($price_node['price_min']) }} - {{ number_format($price_node['price_max']) }} vnđ <i class="fa fa-times" aria-hidden="true"></i></a>
			@endforeach
		@endif
	</div>
	<div class="page_info"> 	
		<p class="p__total_item">@if(count($products) > 0) Hiển thị: <span>{{ $products->firstItem() }}</span> - <span>{{ $products->lastItem() }}</span> trong @endif <span>{{ $products->total()}}</span> sản phẩm</p>
	</div>
@if(count($products) > 0 )
	<div class="row clearfix"  style="width: 100%;" id="list_product">
	@foreach($products as $product)   
	  	<div class="product-item">
			<div class="thumbnail">
				@if($product->promotion_price > 0 )
				<span class="badge badge--sale"><span>Sale</span></span>
				@endif
				@if($product->new == 1 )
		   		<span class="badge badge--new"><span>New</span></span>
		   		@endif
		      	<a href="san-pham/{{$product->id}}/{{$product->slug_name}}.html"><img src="uploaded/product/{{$product->image_product}}" alt="..."></a>
		     	<div class="product-caption text-left">
		        	<p class='product-title'><a href="san-pham/{{$product->id}}/{{$product->slug_name}}.html">{{$product->name}}</a></p>
		        	<p class='product-price'>
	        		@if($product->promotion_price > 0 )
			        	<span class="product__price-on-sale">{{number_format($product->promotion_price)}}</span>
						<s class="product__price--compare">{{number_format($product->unit_price)}}</s> vnđ
					@else
						<span> {{number_format($product->unit_price)}}</span> vnđ
					@endif
		        	</p>
		        <p class='product-btn__p' ><a href="san-pham/{{$product->id}}/{{$product->slug_name}}.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
		      	</div>
		    </div>
	  	</div>
	@endforeach
	</div>
	
	<div class="block_center" id="pagination">
		{{$products->links()}}
	</div>
@else
<p class="text-center messages">Không có sản phẩm phù hợp!</p>
@endif
