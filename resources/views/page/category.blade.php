@extends('layout.master')
@section('content')
<div id='wrapper'>
	<div class="row">
		<div class="col-12 col-sm-2 col-md-2 col-lg-2 nav-left small--text-center">
			<hr class="hr--border-top small-hidden"></hr>
			<nav class="nav__sidebar">
				<ul class=" small--text-center">
					<li >	
                    	<a href="javascript:void(0)">Giày thể thao <span class='glyphicon glyphicon-chevron-down'></span></a>
                        <ul >
                            <li class="active-li"><a href="#">Sub Menu Item</a>
                            </li>
                            <li><a href="#">Sub Menu Item</a>
                            </li>
                            <li><a href="#">Sub Menu Item</a>
                            </li>
                            <li><a href="#" >Sub Menu Item</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#" >Item 2</a>
                    </li>
                    <li><a href="#" >Item 3</a>
                    </li>
                    <li> <a href="javascript:void(0)"  >Duytrung <span class='glyphicon glyphicon-chevron-down' style=""></span></a>
                        <ul>
                            <li><a href="#">Sub Menu Item</a>
                            </li>
                            <li><a href="#">Sub Menu Item</a>
                            </li>
                        </ul>
                    </li>
                </ul>
			</nav>
		</div>
		<div class="col-12 col-sm-12 col-md-10 col-lg-10 block-main-content">
			<div class='main-content'>
			<hr class="hr--border-top small-hidden"></hr>
			<nav class="breadcrumb-nav small--text-center" aria-label="You are here">
			  	<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			    	<a href="/" itemprop="url" title="Back to the homepage">
			      	<span>Home</span>
			    </a>
			    	<span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
			  	</span>
				Nam
			</nav>
			<div class="grid">
				<div class='row'>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center grid__item'>
						<h5>Giày thể thao</h5>
					</div>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center collection-sorting grid__item medium-up--two-thirds'>
						<div class="collection-sorting__dropdown">
				            <label for="SortBy" class="label--hidden">Sort by</label>
				            <select name="SortBy" id="SortBy" data-value="best-selling">
				              <option value="manual">Featured</option>
				              <option value="best-selling">Best Selling</option>
				              <option value="title-ascending">Alphabetically, A-Z</option>
				              <option value="title-descending">Alphabetically, Z-A</option>
				              <option value="price-ascending">Price, low to high</option>
				              <option value="price-descending">Price, high to low</option>
				              <option value="created-descending">Date, new to old</option>
				              <option value="created-ascending">Date, old to new</option>
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
						   		<span class="badge badge--new"><span>New</span></span>
						      	<img src="uploaded/product/{{$product->image_product}}" alt="...">
						     	<div class="product-caption text-left">
						        	<p class='product-title'><a href="">{{$product->name}}</a></p>
						        	<p class='product-price'>
					        		@if($product->promotion_price > 0 )
							        	<span class="product__price-on-sale">{{$product->promotion_price}}</span>
										<s class="product__price--compare">{{$product->unit_price}}</s>
									@else
										<span> {{$product->unit_price}}</span>
									@endif
						        	</p>
						        <p class='product-btn__p' ><a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-shopping-cart"></span></a> <a href="detail.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
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
		<!--end-maincontent-->
	</div>
	<!--block-main-content-->
	</div>
	<!--end-row-->
</div>
<!--end-wrapper-->
@endsection