<!DOCTYPE html>
<html>
<head lang="vi">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<base href="{{asset('')}}" >

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/mystyle.css">
	<link href="css/glyphicons.css" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="asset/font-awesome/css/fontawesome-all.min.css"> -->
</head>
<body>
	<div class="loading-icon">
		<!-- <img src="images/loading-icon.gif"> -->
	</div>
	<div class="container-fluid">
	<div class='register-block form-register'>
    		<p class="login-title text-center">Đăng nhập</p>
    		@if(count($errors)>0)
	            <div class="alert alert-danger">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                @foreach($errors->all() as $err)
	                    {{$err}}<br>
	                @endforeach
	            </div>
	        @endif
            <!-- In Thông báo -->
            @if(session('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!!session('message')!!}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Lỗi</strong>
                    {{session('error')}}
                </div>
            @endif
    		<form action="{{route('post.login')}}" method="post">
    			
				<div class="field field__input-wrapper">
					<label class="field__label" for="input-email">Email</label>
					<input class="field__input" id="input-email" type="email" placeholder="Email"
					Name="txtEmail">
				</div>
				<div class="field field__input-wrapper">
					<label class="field__label" for="input-email">Mật khẩu</label>
					<input class="field__input" id="input-email" type="password" placeholder="Mật khẩu" name="txtPassword">
				</div>
				<div class="field__input-wrapper" style="margin-top: 15px;">
	    			<input type="submit" name="login" value="Đăng Nhập" class="btn__submit" >
	    		</div>
	    		{{ csrf_field() }}
    		</form>
			<div style="clear:both"></div>
		</div>
	<div class='register-block footer-register' style="margin-top: 10px !important;">
		 	<p class="text-center">Bạn chưa có tài khoản? <span><a href="">Đăng ký</a></p>
	</div>
</div>
	<script type="text/javascript" src='js/jquery.min.js'></script>
	<script type="text/javascript" src='js/bootstrap.min.js'></script>
	<script src='js/elevatezoom/jquery.elevatezoom.js'></script>
	<script type="text/javascript" src='js/myscript.js'></script>
	
		@yield('script')
	<script type="text/javascript">
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	</script>

</body>
</html>