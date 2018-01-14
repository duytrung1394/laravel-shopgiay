
	<nav class="nav__sidebar">
		<?php
			if(empty($cate_id)){
				$cate_id = 0;
			}
			dequyCate($cateShare, 0, $newString, $cate_id);
			//Thay thế các thẻ ul li để tạo thành ul li chuẩn, 
			$newString = str_replace("<ul></ul>", "", $newString);
			echo $newString;
		?>
	</nav>
	<!--end-nav__sidebar-->
	