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
		
		$cateShare = Category::get()->toArray();
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
        // 
        $cates = Category::where('parent_id',$id)->get();

        if(count($cates) > 0 )
        {       
            $parent_id = null;
            foreach($cates as $cate)
            {
                $parent_id[] = $cate->id;
                
            }
            $parent =  implode(',',$parent_id);
            $products = Product::whereIn('cate_id',[$id,$parent])->get();
            //nếu là cate cha thi wherein id cate con, va cha
        }else{
            $products = Product::where('cate_id',$id)->get();
        }
        $cate = Category::find($id);
        $cate_id = $id;
        return view('page.category',compact('products','cate','cate_id'));
        
    }
    public function getDetailProduct($id)
    {
        $product        = Product::find($id);
        $cate_id        = $product->cate_id;
        $cates          = Category::find($cate_id);
        //lay cate cha
        $cates_parent   = Category::find($cates->parent_id);
        
        $image_products = ImageProduct::where('product_id', $id)->get();

        return view('page.detail',compact('product','image_products','cate_id','cates','cates_parent'));
        
    }
    public function postAjaxAddtoCart(Request $request)
    {
        $product_id = $request->product_id;
        $size_id = $request->size_id;
        $qty = $request->qty;
        $product = Product::find($product_id);
       
        if($product->promotion_price > 0)
        {
            $price = $product->promotion_price;
        }else{
            $price = $product->unit_price;
        }
        $product_per = ProductProperties::where('product_id',$product_id)->where('size_id',$size_id)->select('quantity')->get();
        $valid = array('success' => false, 'messages' => array());

        foreach($product_per as $pd)
        {
            $quantity = $pd->quantity;
        }
        // nếu số lượng sản phẩm trong cart và selectbox lớn hơn trong database
        $count = Cart::count();
        $quantity_on_cart = 0;
        if($count > 0)
        {
           
            foreach(Cart::content() as $row)
            {
                if(($product_id == $row->id) && ($size_id == $row->options->size_id))
                {
                    $quantity_on_cart = $row->qty;
                }
            }
            $quantity -= $quantity_on_cart ;
        }

        if($qty > $quantity){
            $valid['success'] = false;
            $valid['messages'] = "Sản phẩm đã hết size hoặc vui lòng chọn số lượng nhỏ hơn";
            echo json_encode(
                array(
                    'valid' => $valid
                )
            );
        }else{
            Cart::add(['id' => $product_id, 'name' => $product->name, 'qty' => $qty, 'price' => $price, 'options' => ['size_id' => $size_id, 'image' => $product->image_product, 'slug_name' => $product->slug_name]]);

            $image_product = $product->image_product;
            $product_name  = $product->name;
            $size          = Size::find($size_id);
            $product_size  = $size->name;
            $total_price   = Cart::subtotal(0,"","");
            //nếu đơn hàng hơn 200000 thì free ship
            if($total_price > 2000000)
            {
                $ship_price = 0;
            }else{
                $ship_price = 50000;
            }
            //Tổng tiền bằng tổng trừ ship 
            $total       = $total_price - $ship_price;
            $total       =  number_format($total);
            $total_price = number_format($total_price);
            $ship_price  = number_format($ship_price);
            
            
            $valid['success'] = true;
            $valid['messages'] = "Thành công";
            $cart_count  = Cart::count();
            echo json_encode(
                array( 
                    "product_id"    => "$product_id",
                    "product_name"  => "$product_name",
                    "image_product" => "$image_product",
                    "product_size"  => "$product_size",
                    "total"         => "$total",
                    "qty"           => "$qty",
                    "price"         => "$price",
                    "ship_price"    => "$ship_price",
                    "total_price"   => "$total_price",
                    "cart_count"    => "$cart_count",
                    'quantity_on_cart'      => "$quantity_on_cart",
                    'valid'         => $valid
                )
            );
        }
        
    }
}
