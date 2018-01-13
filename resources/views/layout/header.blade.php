	<div class='top-bar row'>
		<div class="col-md-6 top-bar-left">
			<ul class="nav">
			  <li class="nav-item">
			    <a class="nav-link active" href="#"></a>
			  </li>
			</ul>
		</div>
		<div class="col-md-6 top-bar-right">
			<ul class="nav justify-content-end">
			  	<li class="nav-item cart-link">
			    	<a class="nav-link cart-select"  href="javascript:void(0)"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng <span class="cart__count">@if(Cart::count() > 0) ({{Cart::count()}}) @endif</span></a>
			    	<div class='dropdown-nav popup__cart-body'>
			    		@if(Cart::count() == 0)
			    			<p class="text-center" style="margin-top: 20px;">Chưa có sản phẩm nào</p>
			    		@else

			    		<div class='cart-item cart__list-item'>
			    			@foreach(Cart::content() as $row)
			    			<div class="media">
			    				<a href="javascript:void(0)" class='remove-icon cart-popup__remove-icon' ><span class="glyphicon glyphicon-remove"></span></a>
							  	<img class="" src="uploaded/product/{{$row->options->image}}" alt="image" width="45px">
							  	<div class="media-body">
							    	<p class="mt-0 media__product-title"><a href="san-pham/{{$row->id}}/{{$row->options->slug_name}}.html">{{$row->name}}</a></p>
							    	<?php 	$size = App\Size::find($row->options->size_id);
							    			$size_name  = $size->name;
							    	?>
							    	<p class='product-price product-price__popup'><span>Size: {{$size_name}}</span> | <span class=''>{{$row->price}}</span> * {{$row->qty}}</p>
							  	</div>
							</div>
							@endforeach
			    		</div>
			    		<hr class="hr--border-cart-popup"></hr>
			    		<div class='dropdown-cart__caption'>
			    			<div class='cart-total text-right'><span>Tổng tiền:</span><span>
			    				<?php 
			    			$total_price = Cart::subtotal(0,'','');
			    			// if($total_price > 2000000)
			    			// {
			    			// 	$ship = 0; 
			    			// }
			    			// else{
			    			// 	$ship = 50000;
			    			// } 
			    			$ship = 0;
			    			$total = $total_price - $ship;
			    			echo number_format($total);
			    			?>
			    			vnđ
			    			</span></div>
			    			<hr class="hr--border-cart-popup"></hr>
			    			<div class='text-center dropdown-cart__bottom'>
			    				<a href="{{ route('giohang')}}" class='btn__link btn__link-dropdow-cart'><span class="glyphicon glyphicon-search"></span> Chi tiết</a>
			    				<a href="javascript:void(0)" class='btn__link btn__link-dropdow-cart close_popup_cart'>Tiếp tục mua hàng</a>
			    			</div>
			    		</div>
			    		<?php 	    		
						?>
			    		@endif
			    	</div>
			    	<!-- end-cart-body-->
			  	</li>
			  	<li class="nav-item login-link">
			    	<a class="nav-link small-hidden login-select" href="javascript:void(0)">Đăng nhập</a>
			    	<div class="dropdown-nav popup__login-body small-hidden">
			    		<p class="login-title text-center">Đăng nhập</p>
			    		<div class="field__input-wrapper">
			    			<input type="text" name="txtEmail" placeholder="Email">
			    		</div>
			    		<div class="field__input-wrapper">
			    			<input type="password" name="txtPassword" placeholder="Mật khẩu">
			    		</div>
			    		<div class="field__input-wrapper forgot-password">
			    			<p><a href="#">Quên mật khẩu?</a></p>
			    		</div>
			    		<div class="field__input-wrapper">
			    			<input type="submit" name="login" value="Đăng nhập" class="btn__submit">
			    		</div>
			    	</div>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link small-hidden" href="register.html">Đăng kí</a>
			 	</li>
			</ul>
		</div>
	</div>
	<!-- top-bar -->
	<div class="row" id="header-logo">
		<div class='col-md-6' id='header-logo-left'>
			<p class='p-logo'><a href="">ShopGiay</a></p>
		</div>
		<div class='col-md-6 header-logo-right'>
		</div>
	</div>
	<!-- Header-Logo -->
		<nav class="navbar navbar-default navbar-expand-lg navbar-light bg-light">

			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
			    <span class="navbar-toggler-icon" ></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto menu-list">
			      <li class="nav-item active">
			        <a class="nav-link" href="{{ route('trang-chu') }}">Home <span class="sr-only">(current)</span></a>
			      </li>
			      	@foreach($cateShare as $cate)
			      		@if($cate['parent_id'] == 0)
			      			<?php $cate_child = App\Category::where('parent_id',$cate['id'])->get();
			      			?>
			      			@if(count($cate_child) > 0)
					      		<li class="nav-item dropdown">
							        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							          {{$cate['name']}}
							        </a>
							        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
							          	@foreach($cate_child as $cate_c)
							          		  <a class="dropdown-item" href="danh-muc/{{$cate_c->id}}/{{$cate_c->slug_name}}.html">{{$cate_c->name}}</a>
							          	@endforeach
							        </div>
							    </li>
							 @else
							 	<li class="nav-item">
						         	<a class="nav-link" href="danh-muc/{{$cate->id}}/{{$cate->slug_name}}.html}}">{{$cate-name}}</a>
						      	</li>
							 @endif
			      		@endif
			      	@endforeach
			    
			       <li class="nav-item">
			         <a class="nav-link" href="">Giới thiệu</a>
			      	</li>
			      	<li class="nav-item">
			         <a class="nav-link" href="">Liên Hệ</a>
			      	</li>
			      <li class="nav-item">
			        <a class="nav-link" href="#" id='register-nav-link'>Đâng kí</a>
			      </li>  
			      <li class="nav-item">
			        <a class="nav-link" href="#" id='login-nav-link'>Đăng nhập</a>
			      </li>
			    </ul>
			  </div>
		</nav>
		<!--end-nav-->