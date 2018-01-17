<?php

	function listcate($data, $parent_id = 0, $str = "", $select = 0 )
	{
		foreach ($data as $value) {
			$id = $value['id'];
			$name = $value['name'];
			if($value['parent_id'] == $parent_id)
			{
				
				if($select == $id && $select !=0){
					echo "<option value='" .$id."' selected='selected'>". $str. " ".$name . "</option>";
				}
				else{
					echo "<option value='" .$id."' >". $str. " ".$name . "</option>";
				}
				
				listcate($data, $id, $str . "---",$select);
			}
		}
	}
	
	function unicode_convert_for_regex($str)

    {
        if(!$str) return false;

        $unicode = array(

            'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ'),

                'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'),

                'd'=>array('đ'),

                'D'=>array('Đ'),

                'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'),

                'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'),

                'i'=>array('í','ì','ỉ','ĩ','ị'),

                'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),

                'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ'),

                '0'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'),

                'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự'),

                'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'),

                'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),

                'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
            );

            foreach($unicode as $nonUnicode=>$uni){

              foreach($uni as $value)
                
              $str = str_replace($value,$nonUnicode,$str);

            }
      return $str;
    }
    
    function dequyCate($data, $parent, &$newString, $id) {
        $newString .= "<ul>";
        foreach($data as $key => $cate)
        {
            if($cate['parent_id'] == $parent)
            {
                $active = "";
                if($cate['id'] == $id)
                {
                    $active = "active-li";
                }
                $countCate = App\Category::where('parent_id',$cate['id'])->get()->toArray();

                $span = "";
                $url ="javascript:void(0)";
                if(count($countCate) > 0)
                {
                    //Nếu cố cate con thì hiện thị gly down
                    $span = "<span class='glyphicon glyphicon-chevron-down'></span>";
                }else{
                    //hiện link đến danh mục
                    $url = "danh-muc/$cate[id]/$cate[slug_name].html";
                }
                $cate_name = "<li class='".$active."'><a href='". $url ."'>".$cate['name']." ".$span."</a>";
                $newString .= $cate_name;
                unset($key);
                dequyCate($data, $cate['id'], $newString, $id);
                $newString .= "</li>";
            }
        }
        $newString .= "</ul>";
    }

    function changeColorkeySearch($key, $subject)
    {
        return preg_replace("/($key)/i", "<span class='highlight'>$key</span>" , $subject);
    }
?>