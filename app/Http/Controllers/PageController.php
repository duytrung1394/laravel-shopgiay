<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProductProperties;
use App\Category;
use App\ImageProduct;
use App\Size;
use \Cart;
use App\Coupon;
use Session;
use App\Customer;
use App\Bills;
use App\DetailBill;
use App\Brand;
use App\Http\Requests\CheckoutRequests;
class PageController extends Controller
{
	public function __construct()
	{	
        //truyyền viewshare . loai san pham tới kahcs mọi trang trong page
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
        $brands = Brand::all();
        $sizes = Size::all();
        if(count($cates) > 0 )
        {       
            $parent_id = null;
            foreach($cates as $cate)
            {
                $parent_id[] = $cate->id;
                
            }
            $parent =  implode(',',$parent_id);
            $products = Product::whereIn('cate_id',[$id,$parent])->orderBy('id','DESC')->paginate(8);
            //nếu là cate cha thi wherein id cate con, va cha
        }else{
            $products = Product::where('cate_id',$id)->orderBy('id','DESC')->paginate(8);
        }
        $cate = Category::find($id);
        $cate_id = $id;
        return view('page.category',compact('products','cate','cate_id','brands','sizes'));
        
    }
    public function getDetailProduct($id)
    {
        $product        = Product::find($id);
        $cate_id        = $product->cate_id;
        $cates          = Category::find($cate_id);
        //lay cate cha
        $cates_parent   = Category::find($cates->parent_id);
        
        $diff_products = Product::where('cate_id',$cate_id)->where('id',"<>",$id)->limit(4)->get();
        $image_products = ImageProduct::where('product_id', $id)->get();

        return view('page.detail',compact('product','image_products','cate_id','cates','cates_parent','diff_products'));
        
    }
  
    public function getShowCart(){
        return view('page.cart');
    }

    public function getShowCheckout(){
        return view('page.checkout');
    }

   

    public function postCheckout(CheckoutRequests $request){
        if(Cart::count() > 0)
        {   
            $customer = new Customer;
            $customer->email      = $request->txtEmail;
            $customer->first_name = $request->txtFirstName;
            $customer->last_name  = $request->txtLastName;
            $customer->gender     = $request->txtGender;
            $customer->address    = $request->txtAddress;
            $customer->phone      = $request->txtPhone;
            if($customer->save())
            {   //lưu thonong tin dơn hàng
                $customer_id       = Customer::max('id');   
                $bill = new Bills;
                $bill->customer_id = $customer_id;
                if(session('coupon'))
                {
                    $bill->coupon_id = session('coupon');
                }
                $bill->total_price = $request->txtTotalPrice;
                if($bill->save())
                {   //lưu thông tin chi tiết đơn hàng
                    $bill_id  = Bills::max('id');
                    foreach(Cart::content() as $cart)
                    {
                        $detail_bill = new DetailBill;
                        $detail_bill->bill_id    = $bill_id;
                        $detail_bill->product_id = $cart->id;
                        $detail_bill->size_id    = $cart->options->size_id;
                        $detail_bill->quantity   = $cart->qty;
                        $detail_bill->price      = $cart->subtotal;
                        $detail_bill->save();
                    }
                    Cart::destroy();
                    session()->forget('coupon');
                    return redirect('thanh-toan')->with('success',"Thanh toán thành công. Nhấp vào <a href='' >đây</a> để về trang chủ");
                }else{
                    return redirect('thanh-toan')->with('loi',"Không thể lưu lại thông tin đơn hàng");
                }
            }else{
                 return redirect('thanh-toan')->with('loi',"Không thể lưu lại thông tin khách hàng");
            }
        }else{
            return redirect('thanh-toan')->with('loi',"Giỏ hàng trống");
        }
    }
    
}
