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
			    	<a class="nav-link cart-select"  href="javascript:void(0)"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng</a>
			    	<div class='dropdown-nav popup__cart-body'>
			    		<div class='cart-item cart__list-item'>
			    			<div class="media">
			    				<a href="#" class='remove-icon cart-popup__remove-icon' ><span class="glyphicon glyphicon-remove"></span></a>
							  	<img class="" src="images/anh1.jpg" alt="image" width="45px">
							  	<div class="media-body">
							    	<p class="mt-0 media__product-title"><a href="">Media heading sdasd asdad </a></p>
							    	<p class='product-price product-price__popup'><span>Size: 34</span> | <span class=''>600.000 vnd</span> * 6</p>
							  	</div>
							</div>
							<div class="media">
			    				<a href="#" class='remove-icon cart-popup__remove-icon' ><span class="glyphicon glyphicon-remove"></span></a>
							  	<img class="" src="images/anh1.jpg" alt="image" width="45px">
							  	<div class="media-body">
							    	<p class="mt-0 media__product-title"><a href="">Media heading sdasd asdad </a></p>
							    	<p class='product-price product-price__popup'><span>Size: 34</span> | <span class=''>600.000 vnd</span> * 6</p>
							  	</div>
							</div>
							<div class="media">
			    				<a href="#" class='remove-icon cart-popup__remove-icon' ><span class="glyphicon glyphicon-remove"></span></a>
							  	<img class="" src="images/anh1.jpg" alt="image" width="45px">
							  	<div class="media-body">
							    	<p class="mt-0 media__product-title"><a href="">Media heading sdasd asdad </a></p>
							    	<p class='product-price product-price__popup'><span>Size: 34</span> | <span class=''>600.000 vnd</span> * 6</p>
							  	</div>
							</div>
							<div class="media">
			    				<a href="#" class='remove-icon cart-popup__remove-icon' ><span class="glyphicon glyphicon-remove"></span></a>
							  	<img class="" src="images/anh10.jpg" alt="image" width="45px">
							  	<div class="media-body">
							    	<p class="mt-0 media__product-title"><a href="">Media heading sdasd asdad </a></p>
							    	<p class='product-price product-price__popup'><span>Size: 34</span> | <span class=''>600.000 vnd</span> * 6</p>
							  	</div>
							</div>
			    		</div>
			    		<hr class="hr--border-cart-popup"></hr>
			    		<div class='dropdown-cart__caption'>
			    			<div class='cart-total text-right'><span>Tổng tiền:</span><span>200.000 đ</span></div>
			    			<hr class="hr--border-cart-popup"></hr>
			    			<div class='text-center dropdown-cart__bottom'>
			    				<a href="cart.html" class='btn__link btn__link-dropdow-cart'><span class="glyphicon glyphicon-search"></span> Chi tiết</a>
			    				<a href="index.html" class='btn__link btn__link-dropdow-cart'>Tiếp tục mua hàng</a>
			    			</div>
			    		</div>
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
			        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			      </li>
			      	@foreach($cateShare as $cate)
			      		@if($cate->parent_id == 0)
			      			<?php $cate_child = App\Category::where('parent_id',$cate->id)->get();
			      			?>
			      			@if(count($cate_child) > 0)
					      		<li class="nav-item dropdown">
							        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							          {{$cate->name}}
							        </a>
							        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
							          	@foreach($cate_child as $cate_c)
							          		  <a class="dropdown-item" href="danh-muc/{{$cate_c->id}}/{{$cate_c->slug_name}}.html">{{$cate_c->name}}</a>
							          	@endforeach
							        </div>
							    </li>
							 @else
							 	<li class="nav-item">
						         	<a class="nav-link" href="category.html">{{$cate-name}}</a>
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