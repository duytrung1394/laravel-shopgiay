<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use App\ProductProperties;

use App\Size;

class PageController extends Controller
{
    function getDanhsach()
    {
    	$product = Product::find(1)->product_properties()->where("size_id","=",2)->select("quantity","size_id")->get()->toArray();
    	foreach ($product as $value) {
    		$size_id = $value['size_id'];
    	}
    	
    	$size = Size::find($size_id)->toArray();  
    }
}
