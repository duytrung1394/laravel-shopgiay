@extends('layout.master')
@section('content')
<div id='wrapper'>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-2 col-lg-2 nav-left small--text-center">
			<hr class="hr--border-top small-hidden"></hr>
			<h4>Giày nam</h4>
			<ul class='list--nav small--text-center'>
				<li><a href="" class='site-nav__link'>Thể thao</a></li>
				<li><a href="" class='site-nav__link'>Scandal</a></li>
				<li><a href="" class='site-nav__link'>Boots</a></li>
			</ul>
		</div>
	
		<div class="col-12 col-sm-12 col-md-10 col-lg-10 ">
			<div class='main-content'>
				<hr class="hr--border-top small-hidden"></hr>
			<div class=''>
				<nav class="breadcrumb-nav small--text-center" aria-label="You are here">
				  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				    <a href="index.html" itemprop="url" title="Back to the homepage">
				      <span itemprop="title">Home</span>
				    </a>
				    <span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
				    Nam
				    <span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
				    Giay convers
				  </span>
				
				</nav>
			</div>
			
			<div class='block_wrap row product-single'>
				<div class="col-12 col-sm-12 col-md-7 col-lg-6 product-single__block-left" >
					<span class="badge badge--sale"><span>Sale</span></span>
					<img id='img_01' class="img-view" src="uploaded/product/{{$product->image_product}}" data-zoom-image='uploaded/product/{{$product->image_product}}'/>
						<div id="gallery_01">
						 	@if(count($image_products) > 0)
						 		@foreach($image_products as $image_product)
								 	<a href="#" data-image="uploaded/product/{{$image_product->name}}" data-zoom-image="uploaded/product/{{$image_product->name}}">
									    <img id="img_01" class='thumb-image' src="uploaded/product/{{$image_product->name}}" width="100" />
									</a>
						 		@endforeach
						 	@endif			  
						</div>
				</div>
				<div class="col-12 col-sm-12 col-md-5 col-lg-6 product-content" >
					<h3 class='product-name-detail'>{{$product->name}}</h3>
					<p>{!!$product->description!!}</p>
					<p class="product-price-detail">
						@if($product->promotion_price > 0)
							<span class="product__price-on-sale">{{number_format($product->promotion_price)}}</span>
							<s class="product__price--compare">{{number_format($product->unit_price)}}</s> vnđ
						@else
							<span>{{$product->unit_price}} vnđ</span>
						@endif
						
					</p>
					<div class="slelect-size-box">
						<div class='selector-wrapper'>
							<span><label for='product__select-size'>Size: </label></span>
							<select class="single-option-selector" data-option="option1" id="product__select-size">
								@if(count($product->product_properties) > 0)
									@foreach($product->product_properties as $sizes)

										<?php $size = App\Size::find($sizes->size_id);?>
										<option value="{{$sizes->size_id}}">{{$size->name}}</option>
									@endforeach
								@endif

							</select>
						</div>
						<div class='selector-wrapper'>
							<span><label for='product__select-quantity'>Số lượng: </label></span>
							<select class="single-option-selector" data-option="option1" id="product__select-quantity">
								@for($i = 1; $i<=10 ; $i++)
									<option value="$i">{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					
					<div class="product-submit-cart">
						<a class='btn__link btn__link-cart' href="mua-hang/{{$product->id}}">Mua hàng</a>
					</div>
				</div>
					
			</div>
			<!--end-block_wrap-->
			<div class='product-description'">
				{!!$product->detail!!}
			</div>
			<hr class="hr--border-top small-hidden"></hr>
			<div class='product--different row'>
			  	<div class="product-item">
				    <div class="thumbnail">
				    	<span class="badge badge--sale"><span>Sale</span></span>
				      	<img src="images/anh1.jpg" alt="...">
				     	<div class="product-caption text-left">
				        	<p class='product-title'><a href="">Thumbnail label</a></p>
				        	<p class='product-price'>
				        	<span class="product__price-on-sale">250.000 vnđ</span>
							<s class="product__price--compare">350.000 vnđ</s>
				        	</p>
				        <p class='product-btn__p' ><a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
				      	</div>
				    </div>
			  	</div>    
			  	<div class="product-item">
				    <div class="thumbnail">
				    	<span class="badge badge--new"><span>Sale</span></span>
				      	<img src="images/anh1.jpg" alt="...">
				     	<div class="product-caption text-left">
				        	<p class='product-title'><a href="">Thumbnail label</a></p>
				        	<p class='product-price'>
				        	<span class="product__price-on-sale">250.000 vnđ</span>
							<s class="product__price--compare">350.000 vnđ</s>
				        	</p>
				        <p class='product-btn__p' ><a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
				      	</div>
				    </div>
			  	</div>    
			  	<div class="product-item">
				    <div class="thumbnail">
				    	<span class="badge badge--new"><span>New</span></span>
				      	<img src="images/anh1.jpg" alt="...">
				     	<div class="product-caption text-left">
				        	<p class='product-title'><a href="">Thumbnail label </a></p>
				        	<p class='product-price'>
				        	<span class="product__price-on-sale">250.000 vnđ</span>
							<s class="product__price--compare">350.000 vnđ</s>
				        	</p>
				        	<p class='product-btn__p' ><a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
				      	</div>
				    </div>
			  	</div>    
			  	<div class="product-item">
				    <div class="thumbnail">
				    	<span class="badge badge--sale"><span>Sale</span></span>
				      	<img src="images/anh1.jpg" alt="...">
				     	<div class="product-caption text-left">
				        	<p class='product-title'><a href="">Thumbnail label</a></p>
				        	<p class='product-price'>
				        	<span class="product__price-on-sale">250.000 vnđ</span>
							<s class="product__price--compare">350.000 vnđ</s>
				        	</p>
				        <p class='product-btn__p' ><a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
				      	</div>
				    </div>
			  	</div>   
			  	 
			  
			</div>
			<!--product--different-->
		</div>
		<!--end-main-content-->
	</div>
	<!--end-row-->
</div>
<!--end-wrapper-->
@endsection
@section('script')
	<script type="text/javascript">
 		//initiate the plugin and pass the id of the div containing gallery images
		$("#img_01").elevateZoom({
			zoomType: "inner",
  			cursor: "crosshair",
			constrainType:"height", 
			constrainSize: 274,
			gallery:'gallery_01', 
			// cursor: 'pointer',
			// zoomWindowWidth:400,
			// zoomWindowHeight:500,
			galleryActiveClass: "active"}); 

		//pass the images to Fancybox
		$("#img_01").bind("click", function(e) {  
		  var ez =   $('#img_01').data('elevateZoom');	
			$.fancybox(ez.getGalleryList());
		  return false;
		});
	</script>
@endsection 