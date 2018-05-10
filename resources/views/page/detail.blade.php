@extends('layout.master')
@section('content')
<div id='wrapper'>
	<div class="row">
		<div class="col-12 col-sm-2 col-md-2 col-lg-2 nav-left small--text-center">
		<hr class="hr--border-top small-hidden"></hr>
			@include('layout.sider_nav')
		</div>
	
		<div class="col-12 col-sm-12 col-md-10 col-lg-10 ">
			<div class='main-content'>
				<hr class="hr--border-top small-hidden"></hr>

				<nav class="breadcrumb-nav small--text-center">
					<a href="{{ route('trang-chu') }}">Home</a>
					<span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
					@if(count($cates_parent) > 0)
					<a href="danh-muc/{{$cates_parent->id}}/{{$cates_parent->slug_name}}.html">{{$cates_parent->name}}</a>
					<span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
					@endif
					<a href="danh-muc/{{$cates->id}}/{{$cates->slug_name}}.html">{{$cates->name}}</a>
				    <span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
				    <a href="san-pham/{{$product->id}}/{{$product->slug_name}}.html">{{$product->name}}</a>	
				</nav>

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
								<span>{{number_format($product->unit_price)}} vnđ</span>
							@endif
							
						</p>
						<div class="slelect-size-box">
							<div class='selector-wrapper'>
								<span><label for='product__select-size'>Size: </label></span>
								<select class="single-option-selector" id="product__select-size" 
								>
									@if(count($product->product_properties) > 0)
										@foreach($product->product_properties as $sizes)
											<option value="{{$sizes->size_id}}" data-quantity={{$sizes->quantity}}>{{$sizes->size->name}}	
											</option>
										@endforeach
									@else
										<option value="0">Hết</option>
									@endif
								</select>
							</div>
							<div class='selector-wrapper'>
								<span><label for='product__select-quantity'>Số lượng: </label></span>
								<select class="single-option-selector" id="product__select-quantity">
									@for($i = 1; $i<=10 ; $i++)
										<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
							</div>
						</div>

						<p class='amount-remain'>Còn lại <span id='amount'></span> sản phẩm trong kho</p>

						<div class="product-submit-cart">
							<span class='a__submit'>
								<a href="mua-hang/{{$product->id}}" data-product-id='{{$product->id}}'  @if(count($product->product_properties) == 0)  class='btn__link btn__link-cart btn__add-to-cart disabled'  > Hết hàng @else  class='btn__link btn__link-cart btn__add-to-cart'> Mua hàng <i class="fa fa-shopping-cart" aria-hidden="true"></i> @endif</a>
							</span>
							<!-- data-toggle="modal" data-target=".bd-example-modal-lg" -->
						</div>
					</div>
				</div>
				<!--end-block_wrap-->
				<div class="modal fade bd-example-modal-lg" id='myModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
					    <div class="modal-content">
					      	<div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Thêm vào giỏ hàng thành công</h5>
						        <button type="button" class="close btn__close-icon" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						    </div>
						    <div class="modal-body">
					        	<div class="container-fluid">
					        		<div class="row">
					        			<div class="col-1-4 hidden-small">
					        				<img class='cart__image-product'>
					        			</div>
					        			<div class="col-1-4 hidden-small">
					        				<div class="cart__info-product">
					        					<h5></h5>
					        					<p class="light cart__unit_price"></p>
					        					<p class="light cart__size"></p>
					        					<p class="light cart__qantity"></p>
					        				</div>
					        			</div>
					        			<div class="col-1-5">
					        				<div class="cart__total-info">
					        					<div class="cart__total-header hidden-small">
					        						<h5 class="light">sản phẩm</h5>
						        					<table>
						        						<tr>
						        							<td class="text-left">Tổng giá</td>
						        							<td class="text-right cart__total-price"></td>
						        						</tr>
						        						<tr class="shipping-price">
						        							<td class="text-left">Chi phí ship</td>
						        							<td class="text-right cart__ship-price"></td>
						        						</tr>
						        						<tr>
						        							<td class="text-left">Tổng cộng</td>
						        							<td class="text-right cart__total"></td>
						        						</tr>
						        					</table>
					        					</div>
					        					<div class="cart__total-footer">
					        						<a href="gio-hang" class="btn__link btn__checkout uppercase ">Chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
					        						<a href="thanh-toan" class="btn__link btn__checkout uppercase ">Thanh toán</a>
					        					</div>
					        					
					        				</div>
					        				<!--end-cart-total-->
					        			</div>
					        		</div>
					        	</div>
					      </div>
					      <!--modal-body-->
					    </div>
					    <!--modal-content-->
					  </div>
					</div>
					<!--end-bootstrap-modal-->	
				
				<div class='product-description'>
					{!!$product->detail!!}
				</div>
				<hr class="hr--border-top small-hidden"></hr>
				<div class='product--different block_wrap row'>
					@if(count($diff_products) > 0)
					@foreach($diff_products as $diff_product)

					<div class="product-item">
					    <div class="thumbnail">
					    	@if($diff_product->promotion_price > 0 )
								<span class="badge badge--sale"><span>Sale</span></span>
								@endif
							@if($diff_product->new == 1 )
						   		<span class="badge badge--new"><span>New</span></span>
							@endif
					      	<a href="san-pham/{{$diff_product->id}}/{{$diff_product->slug_name}}.html">
					      		<img src="uploaded/product/{{$diff_product->image_product}}" alt="...">
					      	</a>
					     	<div class="product-caption text-left">
					        	<p class='product-title'><a href="san-pham/{{$diff_product->id}}/{{$diff_product->slug_name}}.html">{{$diff_product->name}}</a></p>
					        	<p class='product-price'>
					        		@if($diff_product->promotion_price > 0 )
							        	<span class="product__price-on-sale">{{number_format($diff_product->promotion_price)}}</span>
										<s class="product__price--compare">{{number_format($diff_product->unit_price)}}</s> vnđ
									@else
										<span> {{number_format($diff_product->unit_price)}} vnđ</span>
									@endif
					        	</p>
								<a href="san-pham/{{$diff_product->id}}/{{$diff_product->slug_name}}.html" class="product-btn__a" role="button"><span class="glyphicon glyphicon-search"></span> Chi tiết</a></p>
					      	</div>
					    </div>
				  	</div> 
				  	@endforeach   
					@endif
				  
				</div>
				<!--productdifferent-->
			</div>
		<!--end-main-content-->
		</div>
	<!--end-row-->
	</div>
<!--end-wrapper-->
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function (){
		// default
		var size_id =  $('#product__select-size').val();
		showQuantity(size_id);

		$('#product__select-size').change(function (){
			size_id = $(this).val();
			$('#product__select-quantity').val(1);
			showQuantity(size_id);
		})
		
		// show Quantity func
		function showQuantity(size_id){
			// lặp qua mỗi option, nếu option value bằng với size_id được chọn thì lấy data-quantity của option đó để hiện thị số lượng sản phẩm trong table
			$("#product__select-size option").each(function (){
			var option_size = $(this).attr('value');
			if(size_id === option_size){
				size_qty = $(this).attr('data-quantity');
					$('#amount').html(size_qty);
					$('#amount').attr('data-qty',size_qty);
				}
			});
		}
		// check quantity choose
		$('#product__select-quantity').change(function (){
			quantity = parseInt($(this).val());
			size_qty = parseInt($('#amount').attr('data-qty'));

			if(size_qty > 0){
				if(size_qty < quantity){
					alert('Vui lòng chọn lại');
					$(this).val(size_qty);
				}
			}else{
				alert('Size này đã hết hàng');
				window.location.reload();
			}
		});

		$('.btn__add-to-cart').click(function (){
			var size_id  = $('#product__select-size').val();
			var qty = $('#product__select-quantity').val();
			var product_id = $(this).attr('data-product-id');
			$.ajax({
				url: "ajax/add-to-cart",
				type: "post",
				dataType: 'json',
				data: "product_id="+product_id+"&size_id="+size_id+"&qty="+qty,
				async: true,
				beforeSend: function()
			    {
			        $('.btn__add-to-cart').html("Mua hàng <i class='fa fa-circle-o-notch fa-spin'></i>");
			    },
			    success: function(data)
			    {
			        if(data.valid.success == false)
			        {
			        	
			        	alert(data.valid.messages);
			        	$('.btn__add-to-cart').html("Mua hàng <i class='fa fa-shopping-cart' aria-hidden='true'></i>");
			        }
			        else{
			        	$('.btn__add-to-cart').html("Mua hàng <i class='fa fa-shopping-cart' aria-hidden='true'></i>");
			        	$('.cart__info-product h5').html(data.product_name);
				        $('p.cart__unit_price').html(data.price+" vnđ");
				        $('p.cart__size').html('Size: '+data.product_size);
				        $('p.cart__quantity').html('Số lượng: '+data.qty);
				        $('.cart__image-product').attr('src','uploaded/product/'+data.image_product);
				        $('.cart__total-info h5').html(data.cart_count+" Sản phẩm");
				        $('.cart__total-price').html(data.total_price+" vnđ");
				        $('.cart__ship-price').html(data.ship_price+" vnđ");
				        $('.cart__total').html(data.total+" vnđ");
				        $('.cart__count').html("("+data.cart_count+")");
				        $("#myModal").modal('show');
			        }
			    }
			});
			return false;
		});
	});
</script>
@endsection 
@section('title')
	{{$product->name}}
@endsection