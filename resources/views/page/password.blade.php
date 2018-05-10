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
						<a href="{{route('get.password')}}">Đổi mật khẩu</a>
					</nav>
				</div>

				<div class='block_wrap row profile_block'>
					<div class='col-8'>
						
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
						<form action='{{ route('post.password')}}' method='post'>
							<div class="form-group">
								<label for="inputOldpassword">Mật khẩu cũ</label>
								<input type="password" class="form-control" id="inputOldPassword" placeholder="Mật khẩu cũ" name="txtOldPassword">
							</div>
							<div class="form-group">
								<label for="inputnewPassword">Mật khẩu mới</label>
								<input type="password" class="form-control" id="inputNewPassword" placeholder="Mật khẩu mới" name="txtNewPassword">
							</div>
							<div class="form-group">
								<label for="inputConfirmPassword">Nhập lại mật khẩu mới</label>
								<input type="password" class="form-control" id="inputConfirmPassword" placeholder="Nhập lại mật khẩu" name="txtConfirmPass">
							</div>
							<div class='footer_profile'>
								<button type='submit' name='submit' class="btn__link btn__small">Đổi mật khẩu</button>
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
	Đổi mật khẩu
@endsection