@extends('layout.master')
@section('content')
<div id='wrapper'>
	<div class="row d-flex check-out__content">
		<div class="col-md-6 col-sm-12 col-12 order-sm-2 order-2 order-md-1 order-lg-1 order-xl-1 main">
			<div class='step'>
				<div class="step__header">
					<nav class="breadcrumb-nav small--text-center" aria-label="You are here">
					  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					    <a href="" itemprop="url" title="Back to the homepage">
					      <span itemprop="title">Giỏ hàng</span>
					    </a>
					    <span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
					    Thông tin khách hàng
					  </span>
					</nav>
					<div class='login_step text-center'>
						@if(Auth::check())
							<p>Bạn đã đăng nhập với tài khoản email <span style="color:#336699">{{Auth::user()->email}}</span></p>
						@else
							<p>* Bạn nên đăng nhập để có thể theo dõi và quản lí đơn hàng một cách tốt hơn</p>
							<div class='mg-20'>
								<a href="{{ route('get.login') }}" class="btn__link btn__small ">Đăng nhập</a>
							</div>
						@endif
					</div>
				</div>
				<div class='step__sections'>
					<div class="section--contact-information">
				<form  action='thanh-toan' method="post">
					<p class='section__title'>Thông tin khách hàng</p>
					<div class="field field__input-wrapper">
						<label class="field__label" for="input-email">Email</label>
						<input class="field__input one-column-form__input--text" id="input-email" name='txtEmail' type="email" placeholder="Email" value="@if(Auth::check()){{ Auth::user()->email }}@else{{ old('txtEmail') }}@endif">
					</div>
					<div style="clear: both;"></div>
					@if(count($errors) > 0)
					 	<div class="alert alert-warning alert-dismissible fade show"  role="alert">
					 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    	<span aria-hidden="true">&times;</span>
						  	</button>
							@foreach($errors->all() as $err)
								{!!$err!!} <br>
							@endforeach
						</div>
						
					@endif
					@if(session('loi'))
						<div class="alert alert-warning alert-dismissible fade show"  role="alert">
					 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    	<span aria-hidden="true">&times;</span>
						  	</button>
							{!!session('loi')!!}
						</div>
					@endif
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show"  role="alert">
					 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    	<span aria-hidden="true">&times;</span>
						  	</button>
							{!!session('success')!!}
						</div>
					@endif
					</div>
					<div class="section--shipping-address">
						<p class='section__title'>Địa chỉ giao hàng</p>
						<div class="field field__input-wrapper field--half">
							<label class="field__label" for="input-ho">Họ</label>
							<input class="field__input" id="input-ho" type="text" placeholder="Họ" name='txtFirstName' value="@if(Auth::check()){{ Auth::user()->first_name }}@else{{old('txtFirstName')}}@endif">
						</div>
						<div class="field field__input-wrapper field--half">
							<label class="field__label" for="input-ten">Tên</label>
							<input class="field__input" id="input-ten" type="text" placeholder="Tên" name="txtLastName" value="@if(Auth::check()){{ Auth::user()->last_name }}@else{{ old('txtLastName') }}@endif">
						</div>
						<div class="field field__input-wrapper field--three">
							<label class="field__label" for="input-gender">Giới tính</label>
							<select class="field__input field__select" id='input-gender' name='txtGender'>
								<?php $gender = Auth::check()? Auth::user()->gender : old('txtGender'); ?>
								<option value="0" @if($gender == 0) selected @endif>Chọn...</option>
								<option value="1" @if($gender == 1) selected @endif>Nam</option>
								<option value="2" @if($gender == 2) selected @endif>Nữ</option>
							</select>
						</div>
						<div class="field field__input-wrapper field--seven">
							<label class="field__label" for="input-phone">Số điện thoại</label>
							<input class="field__input" id="input-phone" type="text" placeholder="Số điện thoại" name='txtPhone' value="@if(Auth::check()){{ Auth::user()->phone }}@else{{ old('txtPhone') }}@endif" maxlength="13">
						</div>
						<div class="field field__input-wrapper">
							<label class="field__label" for="input-address">Địa chỉ</label>
							<input class="field__input" id="input-address" type="text" placeholder="Địa chỉ" name='txtAddress' value="@if(Auth::check()){{ Auth::user()->address }}@else{{ old('txtAddress') }}@endif" >
						</div>
						<div style="clear: both;"></div>
					</div>
				</div>
				<!--step__sections-->
				<div class="step__footer">
					<div class="text-right ">
						<button  type='submit' name='submit' class="btn__link btn__checkout btn__no-margin-right" @if(Cart::count()==0) id='submit-false' @endif >Thanh Toán</button>
					</div>
				</div>
				  {{ csrf_field() }}
				</form>
				
			</div>
			<!--end-step-->
		</div>
		<div class="sidebar-checkout col-md-6 col-sm-12 col-12 order-sm-1 order-1 order-md-2 order-lg-2 order-xl-2">
		  	<div class="sidebar__content">
		  		<div class="text-center">
		  			<button class="show-siderbar__main"><span class="glyphicon glyphicon-shopping-cart"></span> Thông tin giỏ hàng</button>
		  		</div>
		  		<div class="sidebar__main">
		  		@if(Cart::count() > 0)
		  			<div class="order-summary__sections">

		  			<div class="order-summary__product-list">
		  				<table class="product-table">
		  					<thead>
		  						<th class="">
		  							<span class="visually-hidden">Hình ảnh</span>
		  						</th>
		  						<th class="">
		  							<span class="visually-hidden">Mô tả</span>
		  						</th>
		  						<th class="">
		  							<span class="visually-hidden">Tổng giá</span>
		  						</th>
		  					</thead>
		  					<tbody class="product-table__body">
		  					@foreach(Cart::content() as $row)
		  						<tr>
		  							<td class="product__image">
		  								<div class="product-thumbnail">
		  									<div class="product-thumbnail__wrapper">
		  										<img src="uploaded/product/{{$row->options->image}}" class="product-thumbnail__image">
		  										<span class="product-thumbnail__quantity" aria-hidden="true">{{$row->qty}}</span>
		  									</div>
		  								</div>
		  							</td>
		  							<td class="product__description">
		  								<p class="product__description-name">{{$row->name}}</p>
		  								<?php $size = App\Size::find($row->options->size_id);
		  								?>
		  								<p class="product__description-size">Size: {{$size->name}}</p>
		  							</td>
		  							<td class="product__price">
		  								<p class="product__price-price">{{$row->subtotal}}</p>
		  							</td>
		  						</tr>
		  					@endforeach
		  					</tbody>

		  					</table>
		  				</div>
		  			</div>
			  		<!--order-summary__sections-->
			  		<div class="sidebar__footer">
			  			<div class="gift-code">
			  				<?php
								$coupon_value = 0;
								$total_price = 0;
								$total_down = 0;
								$counpon_name = "";
								//nếu đã được add mã giảm giá
								if(session('coupon')) {
								$coupon_id  = session('coupon'); 
								$coupon = App\Coupon::find($coupon_id);
								$coupon_value = $coupon->value;
								$coupon_name = $coupon->name;
								}
								//nếu có cart
								if(Cart::count() > 0) { 
									$total_price = Cart::subtotal(0,'','');
									$total_down = $total_price * $coupon_value;
									$total_price -= $total_down; 
								}
							?>
			  				<div class="field field__input-wrapper seven-col">
							<label class="field__label" for="input-coupon">Mã giảm giá</label>
							<input class="field__input" id="input-coupon" type="text" placeholder="Mã giảm giá" value="@if(session('coupon')) {{$coupon_name}}@endif">
							</div>
							<a class="btn__link btn__no-margin-right three-col uppercase btn__add-coupon" href="javascript:void(0)">Áp dụng <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
							<div style="clear:both"></div>
			  			</div>	
			  			<div class="total-price">
			  				<table class="table_total-info">
			  					<tbody>
			  						<tr>
			  							<td>Tổng tiền</td>
			  							<td class="text-right">{{Cart::subtotal(0,".",",")}} vnđ</td>
			  						</tr>
			  						<tr class="tr__boder-bottom">
			  							<td>Chi phí vận chuyển</td>
			  							<td class="text-right">0 vnđ</td>
			  						</tr>
			  						<tr class="tr__boder-bottom">
			  							<td>Giảm giá</td>
			  							<td class="text-right td__price_down">-{{number_format($total_down)}} vnđ</td>
			  						</tr>
			  						<tr>
			  							<td>Thanh toán</td>
			  							<td class="text-right td__total-price">{{number_format($total_price)}} vnđ</td>
			  						</tr>
			  					</tbody>
			  				</table>
			  			</div>				  										
			  		</div>
			  		<!--sidebar__footer-->
			  		@endif
		  		</div>
		  		<!--sidebar__main-->
		  	</div>

		</div>
	</div>
	<!--end-row-->
</div>
<!--end-wrapper-->
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function (){
			$('.btn__add-coupon').click(function ()
			{
				var coupon = $("#input-coupon").val();
				$.ajax({
					url: 'ajax/add-coupon',
					type: 'post',
					dataType: 'json',
					data: 'coupon='+coupon,
					async: true,
					beforeSend:function (){
						$('.btn__add-coupon').html('Áp dụng <i class="fa fa-circle-o-notch" aria-hidden="true"></i>');
					},
					success: function (data)
					{
						$('.btn__add-coupon').html('Áp dụng <i class="fa fa-chevron-right" aria-hidden="true"></i>');
						if(data.valid.success == false)
						{
							alert(data.valid.messages);
							// $('#input-coupon').val(data.valid.messages);
						}else{
							alert(data.valid.messages);
							$('.td__total-price').html(data.total_price+" vnđ");
							$('.td__price_down').html("-  "+data.total_down+" vnđ");
							$('#input-total-price').val(data.total_price_raw);
						}
					}
				});
			});
			$("#submit-false").click(function (){
				alert('Giỏ hàng trống');
				return false;
			});
		});
		
	</script>
@endsection
@section('title')
	Thanh toán
@endsection