@extends('layout.master')
@section('content')
<div id='wrapper'>
	<div class="row">
		@include('layout.sider_nav')

		<div class="col-12 col-sm-12 col-md-10 col-lg-10 block-main-content">
			<div class='main-content'>
			<hr class="hr--border-top small-hidden"></hr>
			<nav class="breadcrumb-nav small--text-center" aria-label="You are here">
			  	<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			    	<a href="{{ route('trang-chu') }}" itemprop="url" title="Back to the homepage">
			      	<span>Home</span>
			    </a>
			    	<span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
			  	</span>
				Nam
			</nav>
			<div class="grid">
				<div class='row'>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center grid__item'>
						<h5>{{$cate->name}}</h5>
					</div>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center collection-sorting grid__item medium-up--two-thirds'>
						<div class="collection-sorting__dropdown">
				            <label for="SortBy" class="label--hidden">Sort by</label>
				            <select name="SortBy" id="SortBy" data-value="price-ascending">
				              <option value="price-ascending">Giá giảm dần</option>
				              <option value="price-descending">Giá tăng dần</option>
				              <option value="created-descending">Cữ dần</option>
				              <option value="created-ascending">Mới dần</option>
				            </select>
			          	</div>
					</div>
				</div>
			</div>
			<!--end-grid-->
			<div class='block_wrap row'>  
				@if(count($products) > 0 )
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
			  	@else
			  	<p>Chưa có sản phẩm nào trong chuyên mục này</p>
			  	@endif
			</div>
			<!--block_wrap-->
		</div>
		<!--end-main-content-->
	</div>
	<!--block-main-content-->
	</div>
	<!--end-row-->
</div>
<!--end-wrapper-->
@endsection