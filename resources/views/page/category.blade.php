@extends('layout.master')
@section('content')
<div id='wrapper'>
	<div class="row">
		<div class="col-12 col-sm-2 col-md-2 col-lg-2 nav-left small--text-center">
		<hr class="hr--border-top small-hidden"></hr>
			@include('layout.sider_nav')
			<div class="options__checkbox" data-cate-id={{$cate_id}}>
				<div class="brand__checkbox check__group clearfix" id='price-checkbox'>
					<h6>Giá</h6>
						<label class="check_label">Dưới 500.000 vnđ
							<input type="checkbox" data-price-min='0' data-price-max='499999' class="item-filter price filter-price-0-499999">
							<span class="checkmark"></span>
						</label>
						<label class="check_label">Từ 500.000  đên 1.000.000 vnđ
							<input type="checkbox" data-price-min='500000' data-price-max='999999' class="item-filter price filter-price-500000-999999">
							<span class="checkmark"></span>
						</label>
						<label class="check_label">Từ 1.000.000 đến 5.000.000 vnđ
							<input type="checkbox" data-price-min='1000000' data-price-max='5000000' class="item-filter price filter-price-1000000-5000000">
							<span class="checkmark"></span>
						</label>
						<label class="check_label">Trên 5.000.000 vnđ
							<input type="checkbox" data-price-min='5000000' data-price-max='100000000' class="item-filter price filter-price-5000000-100000000">
							<span class="checkmark"></span>
						</label>
				</div>
				<div class="brand__checkbox check__group clearfix" id='brand-checkbox'>
					<h6>Thương hiệu</h6>
					@if(count($brands) > 0)
						@foreach($brands as $brand)
					 	<label class="check_label">{{$brand->name}}
						  	<input type="checkbox" value="{{$brand->id}}" class="item-filter brand filter-brand-{{$brand->id}}">
						  	<span class="checkmark"></span>
						</label>
						@endforeach
					@endif
				</div>
				<div class="size__checkbox check__group clearfix" id='size-checkbox'>
					<h6>Kích Cỡ</h6>
					@if(count($sizes) > 0)
						@foreach($sizes as $size)
	            			<input type="checkbox"  value="{{$size->id}}" id='size-{{$size->id}}' class="item-filter size filter-size-{{$size->id}}">
		            		<label for="size-{{$size->id}}">{{$size->name}}</label>
						@endforeach     
					@endif
				</div>
			</div>		
		</div>
		<div class="col-12 col-sm-12 col-md-10 col-lg-10 block-main-content">
			<div class='main-content'>
			<hr class="hr--border-top small-hidden"></hr>
			<nav class="breadcrumb-nav small--text-center" aria-label="You are here">
			  	<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			    	<a href="{{ route('trang-chu') }}" itemprop="url" title="Back to the homepage">
			      	<span>Home</span>
			    </a>
				@if(!empty($cate_parent))
			    	<span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
			  	</span>
				  	{{ $cate_parent->name }}
				@endif
			</nav>
			<div class="grid">
				<div class='row'>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center grid__item'>
							<h5>{{$cate->name}}</h5>
					</div>
					<div class='col-12 col-sm-12 col-md-6 col-lg-6  small--text-center collection-sorting grid__item medium-up--two-thirds'>
						<div class="collection-sorting__dropdown">
				            <label for="SortBy" class="label--hidden" >Sort by</label>
				            <select name="SortBy" id="SortBy" data-cate-id='{{$cate_id}}'>
				              	<option value="price-ascending">Giá tăng dần</option>
				              	<option value="price-descending">Giá giảm dần</option>
				              	<option value="created-descending">Mới nhất</option>
				              	<option value="created-ascending">Cũ nhất</option>
				            </select>
			          	</div>
						<div class="collection-sorting__dropdown">
				            <label for="itemsOnPage" class="label--hidden" >Hiển thị</label>
				            <select name="itemsOnPage" id="itemsOnPage">
				              	<option value="8">8 sản phẩm</option>
				              	<option value="12">12 sản phẩm</option>
				              	<option value="16">16 sản phẩm</option>
				              	<option value="25">25 sản phẩm</option>
				            </select>
			          	</div>
					</div>
				</div>
			</div>
			<!--end-grid-->
			<div class='block_wrap row' id="pd">
				
					<div class="row filter-tag">
					</div>
					<div class="page_info"> 	
						<p class="p__total_item">@if(count($products) > 0) Hiển thị: <span>{{ $products->firstItem() }}</span> - <span>{{ $products->lastItem() }}</span> trong @endif <span>{{ $products->total()}}</span> sản phẩm</p>
					</div>
					
					@if(count($products) > 0 )
					<div class="row clearfix" style="width: 100%;" id="list_product"> 
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
			  			<div class="block_center block_paginate">
			  				{{$products->links()}}
			  			</div>
			  	
				  	@else
				  		<p class="text-center messages">Không có sản phẩm phù hợp!</p>
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
@section('title')
	{{$cate->name}}
@endsection
@section('script')
	<script type="text/javascript">
		
		$(document).ready(function (){
			var cate_id  = $(".options__checkbox").attr('data-cate-id');
			var data = {
				cate_id : cate_id,
				brand_list : [],
				size_list : [],
				sortby: "",
				itemsOnPage : 8,
				page : 1
			}
			//filter check
			$(".item-filter").change(function (){
				var brand_list  = new Array();
				var size_list   = new Array();
				brand_list      = multi_checkbox("brand"); //call multi_checkbox, get list id
				size_list       = multi_checkbox('size');
				price_list = multi_checkbox('price');
				data.page       = 1; 			//khi check thi luon gửi page 1, tránh lỗi khi số page bé hơn page đang gửi hiện tại
				data.brand_list = brand_list;  	//list_brand for ajax send
				data.size_list  = size_list;	//get size_list
				data.price_list = price_list;
				// console.log(price_list);
				ajax();
			});
			//khi click remove tag

			$(".block_wrap").delegate(".remove-tag","click",function (e){
				e.preventDefault();
				var  tag_id = $(this).attr('data-tag'); //lay id cua filter-item
				$("."+tag_id).prop('checked', false); 	//Chuyển checkbox có data-tag thành false
				console.log(tag_id);
				var brand_list  = new Array();
				var size_list   = new Array();
				var price_list   = new Array();
				brand_list      = multi_checkbox('brand'); 
				size_list       = multi_checkbox('size');
				price_list       = multi_checkbox('price');
				data.page       = 1; 				
				data.brand_list = brand_list;  
				data.size_list  = size_list;
				data.price_list = price_list;	
				ajax();
			});

			//lấy giá trị sort by
			$("#SortBy").change(function (){
				var val = $(this).val();
				data.sortby = val;
				ajax();
			});
			// lấy số item on page
			$("#itemsOnPage").change(function (){
				var val = $(this).val();
				data.itemsOnPage = val;
				ajax();
			});

			$(".block_wrap").on('click','#pagination a', function (event) {
				event.preventDefault();
				var page  = $(this).attr('href').split('page=')[1];
				data.page = page; //để có thể phân trang bên page phải gửi data.page qua ajax
				ajax();
			});

			function ajax(){
				$.ajax({
					url: "ajax/filter",
					type: "post",
					data: data,
					async: true,
					beforeSend:function (){
						$(".loading-icon").fadeIn('fast');
					},
					success:function (data){
						$(".loading-icon").fadeOut('fast');
						$('.block_wrap').html(data);
					},
					errors:function (){
						alert('fasle');
					}
				});	
			}
			//lấy danh sach checkbox
			function multi_checkbox(class_check){
				var val = new Array();
				if(class_check === 'price'){
					$(".price:checked").each(function (){
						var price_check = {
							price_min : $(this).attr('data-price-min'),
							price_max : $(this).attr('data-price-max')
						}
						val.push(price_check);
					});
				}else{
					$("."+class_check+":checked").each(function (){
					val.push($(this).val());
					});
				}
				return val;
			};
		});
	</script>
@endsection