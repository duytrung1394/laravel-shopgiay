@extends('layout.master')
@section('content')
<div id='wrapper'>
	<div class="row">
		<div class="col-12 col-sm-2 col-md-2 col-lg-2 nav-left small--text-center">
			<hr class="hr--border-top small-hidden"></hr>
			@include('layout.user_sider_nav')
			<!--end-nav__sidebar-->
		</div>

		<div class="col-12 col-sm-12 col-md-10 col-lg-10 ">
			<div class='main-content'>
				<hr class="hr--border-top small-hidden"></hr>
				<div class=''>
					<nav class="breadcrumb-nav small--text-center" aria-label="You are here">
						<a href="index.html" itemprop="url" title="Back to the homepage">
							<span itemprop="title">Home</span>
						</a>
						<span class="breadcrumb-nav__separator" aria-hidden="true">›</span>
						<a href="{{ route('list.bill') }}">Danh sách hóa đơn</a>
					</nav>
				</div>

				<div class='block_wrap row profile_block'>
					<div class='col-11'>
						<p class='section__title'>Danh sách hóa đơn</p>
						<p class='p__total_item'>Hiện thị: <span>{{ $customers->firstItem() }}</span> - <span>{{ $customers->lastItem() }}</span> của <span>{{ $customers->total()}}</span> hóa đơn</p>
						<table class="table">
							<thead>
								<tr>
									<th>STT</th>
									<th>Ngày đặt hàng</th>
									<th>Coupon</th>
									<th>Tổng tiền</th>
									<th>Chi tiết hóa đơn</th>
								</tr>
							</thead>
							<tbody>
							@if(count($customers) > 0)
								<?php $stt = 1; ?>
							
								@foreach($customers as $index => $customer)
									
									<?php $bill = $customer->bill; ?>
									<tr>
										<td>{{ $index + $customers->firstItem() }}</td>
										<td>{{ date('d-m-Y', strtotime($bill->created_at)) }}</td>
										<td> @if($bill->coupon_id) {{ $bill->coupon->name }} @else Không sử dụng @endif</td>
										<td>{{ number_format($bill->total_price) }} vnđ</td>
										<td>
											<button class='btn btn-primary btn-sm show-bills' data-toggle="modal" data-target=".show-bills-modal" data-bill-id="{{ $bill->id }}">Chi tiết</button>
										</td>
									</tr>
									
								@endforeach
							@else
								<tr>
									<td colspan="4">Chưa có hóa đơn nào</td>
								</tr>
							@endif	
							</tbody>
						</table>
					</div>
					<div class='col-1'>

					</div>
					<div class="block_center block_paginate">
			  			{{$customers->links()}}
			  		</div>
				</div>
				<!--end-block_wrap-->
				<div class="modal fade show-bills-modal" id='myModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title label-bold" id="exampleModalLabel">Chi tiết đơn hàng</h5>
								<button type="button" class="close btn__close-icon" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body list-bills">
								
							</div>
							<!--modal-body-->
						</div>
						<!--modal-content-->
					</div>
				</div>
				<!--end-modal-->
			</div>
			<!--end-main-content-->
		</div>
	</div>
	<!--end-row-->
</div>
	
@endsection	

@section('title')
	Danh sách hóa đơn
@endsection

@section('script')
	<script type="text/javascript" >
		$(document).ready(function (){
			$(".show-bills").click(function(){
				var bill_id = $(this).attr("data-bill-id");
				$.ajax({
					url: "user/danh-sach-hoa-don",
					type: "post",
					data: "bill_id="+bill_id,
					async: true,
					success: function(data){
						$(".list-bills").html(data);
					}
				});
			})
		});
	</script>
@endsection