<div class="container-fluid ">
	<div class="row user-info">
		<div class='col-12'>
			<p>
				<label class='label-bold'> Email: </label>
				<span id="email">{{ $customer->email }}</span>
			</p>
		</div>
		<div class='col-md-6 col-sm-12'>
			<p>
				<label class='label-bold'> Họ: </label>
				<span id="firstName"> {{ $customer->first_name }}</span>
			</p>
		</div>
		<div class='col-md-6 col-sm-12'>
			<p>
				<label class='label-bold'> Tên: </label>
				<span id="lastName">{{ $customer->last_name }}</span>
			</p>
		</div>
		<div class='col-md-6 col-sm-12'>
			<p>
				<label class='label-bold'> Giới tính: </label>
				<span id="gender">@if($customer->gender == 1) Nam @elseif($customer->gender == 2) Nữ @else Không xác định @endif</span>
			</p>
		</div>
		<div class='col-md-6 col-sm-12'>
			<p>
				<label class='label-bold'> Số điện thoại: </label>
				<span id="phone">{{ $customer->phone }}</span>
			</p>
		</div>
		<div class='col-12'>
			<p>
				<label class='label-bold'> Địa chỉ: </label>
				<span id="address"> {{ $customer->address }}</span>
			</p>
		</div>

	</div>
	<div class="row">
		<table class='responsive-table table--no-border'>
			<thead class='cart__row small-hidden'>
				<tr>
					<th class="text-left cart__table-cell-image">Sản phẩm</th>
					<th class="text-center cart__table-cell--meta"></th>
					<th class="text-center cart__table-cell--quantity">Số lượng</th>
					<th class="text-center cart__table-cell--quantity">Đơn giá</th>
					<th class="text-right cart__table-cell--total-price">Tổng</th>
				</tr>
			</thead>
			<tbody>
			@if(count($bill_detail) > 0)
				@foreach($bill_detail as $index => $row)
				<tr class='responsive-table__row'>
					<td class="text-left cart__table-cell-image">
						<img src="uploaded/product/{{ $row->product->image_product }}" width='100%' />
					</td>
					<td class="cart__table-cell--meta small--text-center">
						<p>
							<a href="detail.html">
								{{ $row->product->name }}
							</a>
							<p>Size: {{ $row->size->name }}</p>
						</p>

					</td>
					<td class='cart__table-cell--quantity medium-up--text-center' data-label='Số lượng'>
						<span>{{ $row->quantity }}</span>
					</td>
					<td class="cart__table-cell--price medium-up--text-center" data-label='Đơn giá'>@if($row->unit_price == null) Không xác định @else{{ number_format($row->unit_price) }} @endif</td>
					<td class='cart__table-cell--quantity text-right' data-label="Giá trả">{{ number_format($row->sub_price) }} vnđ</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4">Giỏ hàng đã bị xóa</td>
				</tr>
			@endif
			</tbody>
		</table>
		<div class='cart-footer text-right'>
			<p class='small--text-center'>
				<span>Tổng tiền: </span>
				<span class='span__total_price'>{{ number_format($bills->total_price) }} vnđ</span>
			</p>
		</div>
	</div>
</div>