<div class="col-12 col-sm-2 col-md-2 col-lg-2 nav-left small--text-center">
	<hr class="hr--border-top small-hidden"></hr>
	<nav class="nav__sidebar">
		<?php

			dequyCate($cateShare, 0, $newString, $cate_id);
			//Thay thế các thẻ ul li để tạo thành ul li chuẩn, 
			$newString = str_replace("<ul></ul>", "", $newString);
			echo $newString;
		?>
	</nav>
	<!--end-nav__sidebar-->
</div>