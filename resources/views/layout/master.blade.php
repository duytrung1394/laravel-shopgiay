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
	<!-- <link rel="stylesheet" type="text/css" href="asset/font-awesome/css/fontawesome-all.min.css"> --> <!--not full icon-->
</head>
<body>
	<div class="loading-icon">
		<!-- <img src="images/loading-icon.gif"> -->
	</div>
	<div class="container-fluid">
		@include('layout.header')
		
		@yield('content')

		@include('layout.footer')
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