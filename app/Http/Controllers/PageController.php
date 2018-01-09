<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductProperties;
use App\Category;
use App\ImageProduct;
use App\Size;
use \Cart;
class PageController extends Controller
{
	public function __construct()
	{	//truyyền viewshare . loai san pham tới kahcs mọi trang trong page
		
		$cateShare = Category::all();
		view()->share(['cateShare'=>$cateShare]);
	}
    public function getIndexPage()
    {
    	$new_product = Product::where('new',1)->select('id','name','slug_name','image_product','unit_price','promotion_price','new')->limit(5)->get();
    	
    	$sale_product = Product::where('promotion_price','>',0)->select('id','name','slug_name','image_product','unit_price','promotion_price','new')->limit(5)->get();
    	
    	return view('page.index',compact('new_product','sale_product'));
    }
    public function getCategory($id)
    {   
        $products = Product::where('cate_id',$id)->get();
        
        return view('page.category',compact('products'));
        
    }
    public function getDetailProduct($id)
    {
        $product = Product::find($id);
        $image_products = ImageProduct::where('product_id', $id)->get();
        return view('page.detail',compact('product','image_products'));
        
    }
    public function getAddCart($id)
    {
        $product = Product::find($id);
        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->unit_price, 'options' => ['size_id' => '1']]);
        
    }
}
