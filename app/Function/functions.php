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
?>