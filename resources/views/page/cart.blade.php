@extends('layout.master')
@section('content')
<!--end-nav-->
<div id='wrapper'>
	<div class="row">
		<div class="col-12 col-sm-2 col-md-2 col-lg-2 nav-left small--text-center">
		<hr class="hr--border-top small-hidden"></hr>
			@include('layout.sider_nav')
		</div>
	
		<div class="col-12 col-sm-12 col-md-10 col-lg-10 ">
			<div class='main-content'>
				<hr class="hr--border-top small-hidden"></hr>
			<div class=''>
				<nav class="breadcrumb-nav small--text-center" aria-label="You are here">
				    <a href="{{ route('trang-chu')}}" itemprop="url" title="Back to the homepage">
				      <span itemprop="title">Home</span>
				    </a>
				    <span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
				    <a href="gio-hang">Giỏ hàng</a>
				</nav>
			</div>
			
			<div class='block_wrap row'>
				@if(Cart::count() > 0)
				<table class='responsive-table table--no-border'>
					<thead class='cart__row small-hidden'>
						<tr>
							<th class="text-left cart__table-cell-image">Sản phẩm</th>
							<th class="text-center cart__table-cell--meta"></th>
							<th class="text-center cart__table-cell--price">Đơn giá</th>
							<th class="text-center cart__table-cell--quantity">Số lượng</th>
							<th class="text-right cart__table-cell--total-price">Tổng</th>
						</tr>
					</thead>
					<tbody>
						@foreach(Cart::content() as $cart)
						<?php 	$cart_product = App\Product::find($cart->id);
								$size_name = App\Size::find($cart->options->size_id);
						?>	
						<tr class='responsive-table__row'>
							
							<td class="text-left cart__table-cell-image"><img src="uploaded/product/{{$cart->options->image}}" width='100%'/></td>
							<td class="cart__table-cell--meta small--text-center"><p>
            					<a href="san-pham/{{$cart->id}}/{{$cart_product->slug_name}}.html"><h6>{{$cart->name}}</h6></a>
              					<small>Size: {{$size_name->name}}</small>
          						</p>
          						<p><a href="javascript:void(0)" class='btn-del__cart-item remove-product-item' data-rowId='{{$cart->rowId}}'>Remove</a></p>
      						</td>
      						<td class="cart__table-cell--price medium-up--text-center" data-label='Đơn giá'>{{number_format($cart->price)}} vnđ</td>
      						<td class='cart__table-cell--quantity medium-up--text-center' data-label='Số lượng'>
      							<select class="single-option-selector quantity-selector" data-option="option1" data-rowId='{{$cart->rowId}}'>
									@for($i = 1; $i<=20 ; $i++)
										<option value="{{$i}}" @if($cart->qty == $i) selected @endif >{{$i}}</option>
									@endfor
								</select>
      						</td>
      						<td class='cart__table-cell--quantity text-right quantity-{{$cart->rowId}}' data-label="Tổng">{{number_format($cart->subtotal)}} vnđ</td> 
      					</tr>
						@endforeach
					</tbody>
				</table>
				<div class='cart-footer text-right'>
					<?php $total_price = Cart::subtotal(0,'','');
							$ship_price = 0;
					?>
					
					<p class='small--text-center'>
						<span>Tổng tiền: </span>
						<span class='span__total_price'>{{number_format($total_price)}} vnđ</span>
					</p>
					<div class='cart-bottom-footer'>
						<a href="thanh-toan" class='btn__link btn__link-cart'>Thanh toán</a>
	    				<a href="" class='btn__link btn__link-cart'>Tiếp tục mua hàng</a>
					</div>
				</div>
				
				@else
				<p>Chưa có sản phẩm nào trong Giỏ hàng</p>
				@endif
			</div>
			<!--end-block_wrap-->						
		<!--product-different-->
		</div>
		<!--end-main-content-->
	</div>
</div>
	<!--end-row-->
</div>
<!--end-wrapper-->
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function (){
			$(".quantity-selector").change(function (){
				var rowId = $(this).attr('data-rowId');
				var quantity = $(this).val();

				$.ajax({
					url: "ajax/xuly-quantity",
					type: "post",
					data: "rowId="+rowId+"&quantity="+quantity,
					dataType: "json",
					async: true,
					success:function (data){
						if(data.valid.success == true){
							
							$(".span__total_price").html(data.total_price+" vnđ");
							$(".quantity-"+rowId).html(data.row_total+" vnđ");
						}
						 else{
							alert(data.valid.messages);
							window.location.reload();
					 }
					},
					error:function(){
						alert('Yêu cầu của bạn không được đáp ứng');
						window.location.reload();
					}
				});
			});
		});
	</script>
@endsection
@section('title')
	Giỏ hàng
@endsection