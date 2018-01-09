@extends('layout.master')
@section('content')

	<div id='wrapper'>
		<div id='new-product' class='block-content'>
		<div class="row">
			<div class='title-heading col-12'>
				<h5>Sản phẩm khuyến mãi</h5>
			</div>
			<div class="block_wrap row">
				@if(count($sale_product) > 0) 
					@foreach($sale_product as $sp)
						<div class="product-item">
							<div class="thumbnail">
								@if($sp->new == 1)
						      	<span class="badge badge--new"><span>New</span></span>
						      	@endif
						   		<span class="badge badge--sale"><span>Sale</span></span>
						      	<img src="uploaded/product/{{$sp->image_product}}" alt="...">
						     	<div class="product-caption text-left">
						        	<p class='product-title'><a href="">{{$sp->name}}</a></p>
						        	<p class='product-price'>
					        		@if($sp->promotion_price > 0 )
							        	<span class="product__price-on-sale">{{$sp->promotion_price}}</span>
										<s class="product__price--compare">{{$sp->unit_price}}</s>
									@else
										<span> {{$sp->unit_price}}</span>
									@endif
						        	</p>
						        <p class='product-btn__p' ><a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="san-pham/{{$sp->id}}/{{$sp->slug_name}}.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
						      	</div>
						    </div>
					  	</div>
					@endforeach
				@endif
			
			</div>
			<!--end-block-wrap-->
			</div>
			<!--end-row -->
		</div>
		<!--end-new-product-->
		<div id='sale-product' class='block-content'>
		<div class="row">
			<div class='title-heading col-12'>
				<h5><a href="">Sản phẩm mới</a></h5>
			</div>
			<div class='block_wrap row'>
				@if(count($new_product) > 0) 
					@foreach($new_product as $np)
						<div class="product-item">
							<div class="thumbnail">
								@if($np->promotion_price > 0 )
								<span class="badge badge--sale"><span>Sale</span></span>
								@endif
						   		<span class="badge badge--new"><span>New</span></span>
						      	<img src="uploaded/product/{{$np->image_product}}" alt="...">
						     	<div class="product-caption text-left">
						        	<p class='product-title'><a href="">{{$np->name}}</a></p>
						        	<p class='product-price'>
					        		@if($np->promotion_price > 0 )
							        	<span class="product__price-on-sale">{{$np->promotion_price}}</span>
										<s class="product__price--compare">{{$np->unit_price}}</s>
									@else
										<span> {{$np->unit_price}}</span>
									@endif
						        	</p>
						        <p class='product-btn__p' ><a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="san-pham/{{$np->id}}/{{$np->slug_name}}.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
						      	</div>
						    </div>
					  	</div>
					@endforeach
				@endif
				    
			</div>
			<!--end-block-wrap-->
			</div>
			<!--end-row -->
		</div>
		<!--end-new-product-->
	</div>
@endsection	
