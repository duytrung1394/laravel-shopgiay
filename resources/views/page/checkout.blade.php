@extends('layout.master')
@section('content')
<div id='wrapper'>
	<div class="row d-flex check-out__content">
		<div class="col-md-6 col-sm-12 col-12 order-sm-2 order-2 order-md-1 order-lg-1 order-xl-1 main">
			<div class='step'>
				<div class="step__header">
					<nav class="breadcrumb-nav small--text-center" aria-label="You are here">
					  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					    <a href="index.html" itemprop="url" title="Back to the homepage">
					      <span itemprop="title">Giỏ hàng</span>
					    </a>
					    <span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
					    Thông tin khách hàng
					    <span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
					    Shipping
					  </span>
					</nav>
				</div>
				<div class='step__sections'>
					<div class="section--contact-information">
					<p class='section__title'>Thông tin khách hàng</p>
					<div class="field field__input-wrapper">
						<label class="field__label" for="input-email">Email</label>
						<input class="field__input one-column-form__input--text" id="input-email" type="email" placeholder="Email">
					</div>
					<div style="clear: both;"></div>
					</div>
					<div class="section--shipping-address">
						<p class='section__title'>Địa chỉ giao hàng</p>
						<div class="field field__input-wrapper field--half">
							<label class="field__label" for="input-email">Họ</label>
							<input class="field__input" id="input-ho" type="text" placeholder="Họ">
						</div>
						<div class="field field__input-wrapper field--half">
							<label class="field__label" for="input-email">Tên</label>
							<input class="field__input" id="input-ten" type="text" placeholder="Tên">
						</div>
						<div class="field field__input-wrapper">
							<label class="field__label" for="input-email">Số điện thoại</label>
							<input class="field__input" id="input-ten" type="text" placeholder="Số điện thoại">
						</div>
						<div class="field field__input-wrapper">
							<label class="field__label" for="input-email">Địa chỉ</label>
							<input class="field__input" id="input-ten" type="text" placeholder="Địa chỉ">
						</div>
						<div class='field field__input-wrapper field__input-active field--half'>
							<label class="field__label" for="input-province">Tỉnh</label>
							<select class="field__input field__select" id='input-city'>
								<option value="1">Nghệ an</option>
								<option value="2">Thành phố hồ chí minh</option>
								<option value="3">Hà nội</option>
							</select>
						</div>
						<div class='field field__input-wrapper field__input-active field--half '>
							<label class="field__label" for="input-city">Huyện/Thành phố</label>
							<select class="field__input field__select" id='input-city'>
								<option value="1">Vinh</option>
								<option value="2">Nghệ an</option>
								<option value="3">Hà nội</option>
							</select>
						</div>
						<div style="clear: both;"></div>
					</div>
				</div>
				<!--step__sections-->
				<div class="step__footer">
					<div class="text-right ">
						<a href="javascript:void(0)" class="btn__link btn__checkout btn__no-margin-right">Tiếp tục thanh toán</a>
					</div>
				</div>
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
		  								<?php $size_name = App\Size::find($row->qty);?>
		  								<p class="product__description-size">Size: {{$size_name->name}}</p>
		  							</td>
		  							<td class="product__price">
		  								<p class="product__price-price">{{$row->price}}</p>
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
			  				<div class="field field__input-wrapper seven-col">
							<label class="field__label" for="input-email">Mã giảm giá</label>
							<input class="field__input" id="input-ten" type="text" placeholder="Mã giảm giá">
							</div>
							<a class="btn__link btn__no-margin-right three-col" href="javascript:void(0)">Áp dụng</a>
							<div style="clear:both"></div>
			  			</div>	
			  			<div class="total-price">
			  				<table class="table-total-price">
			  					<tbody>
			  						<tr>
			  							<td>Tổng tiền</td>
			  							<td class="text-right">{{Cart::subtotal(0,".",",")}} vnđ</td>
			  						</tr>
			  						<tr class="shipping-price">
			  							<td>Chi phí vận chuyển</td>
			  							<td class="text-right">0 vnđ</td>
			  						</tr>
			  						<tr>
			  							<td>Thanh toán</td>
			  							<td class="text-right">{{Cart::subtotal(0,".",",")}} vnđ</td>
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