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
						<a href="{{route('user.profile')}}">Thông tin cá nhân</a>
					</nav>
				</div>

				<div class='block_wrap row profile_block'>
					<div class='col-8'>
						<p class='section__title'>Thông tin cá nhân</p>
						@if(count($errors)>0)
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								@foreach($errors->all() as $err)
									{{$err}}<br>
								@endforeach
							</div>
						@endif
						@if(session('success'))
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{!!session('success')!!}
							</div>
						@endif
						@if(session('error'))
							<div class="alert alert-warning">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{!!session('error')!!}
							</div>
						@endif
						<form action="{{ route('user.profile') }}" method='post'>
							<div class="form-group">
								<label for="inputAddress">Email</label>
								<input type="email" class="form-control" id="inputAddress" placeholder="Nhập vào email" name="txtEmail" value="@if(Auth::check()){{Auth::user()->email}}@endif">
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="firstname">Họ</label>
									<input type="text" class="form-control" id="firstname" placeholder="Nhập họ đệm..." name="txtFirstName" value="@if(Auth::check()){{Auth::user()->first_name}}@endif">
								</div>
								<div class="form-group col-md-6">
									<label for="lastname">Tên</label>
									<input type="text" class="form-control" id="lastname" name="txtLastName" placeholder="Nhập tên..." value="@if(Auth::check()){{Auth::user()->last_name}}@endif" name="txtLastName">
								</div>
							</div>
						
							<div class="form-group">
								<label for="inputAddress">Địa chỉ</label>
								<input type="text" class="form-control" id="inputAddress" placeholder="Nhập vào địa chỉ..." name="txtAddress" value="@if(Auth::check()){{Auth::user()->address}}@endif">
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="inputGender">Giới tính</label>
									<select id="inputGender" class="form-control" name='txtGender'>
									<?php if(Auth::check()) {$gender = Auth::user()->gender;}?>
										<option value="0" @if($gender == 0) selected @endif >Chọn...</option>
										<option value="1" @if($gender == 1) selected @endif >Nam</option>
										<option value="2" @if($gender == 2) selected @endif >Nữ</option>
									</select>
								</div>
								<div class="form-group col-md-8">
									<label for="inputPhone">Số điện thoại</label>
									<input type="text" class="form-control" id="inputPhone" placeholder="Số điện thoại" name='txtPhone' value="@if(Auth::check()){{Auth::user()->phone}}@endif" maxlength="13">
								</div>
							</div>
							<div class='footer_profile'>
								<button type='submit' name='submit' class="btn__link btn__small">Cập nhật thông tin </button>
							</div>
							{{ csrf_field() }}
						</form>
					</div>
					<div class='col-4'>

					</div>
				</div>
				<!--end-block_wrap-->
			</div>
			<!--end-main-content-->
		</div>
	</div>
    <!--end-row-->
</div>
	
@endsection	
@section('title')
	Thông tin cá nhân
@endsection