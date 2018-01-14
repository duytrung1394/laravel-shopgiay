@if(count($products) > 0 )
		<div class="row"  style="width: 100%;">
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
	<div style="clear:both"></div>
	<div id="phantrang">
		{{$products->links()}}
	</div>
	
@else
<p>Chưa có sản phẩm nào trong chuyên mục này</p>
@endif
