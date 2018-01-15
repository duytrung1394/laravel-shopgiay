<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $brands = Brand::all();

        if(count($cates) > 0 )
        {       
            $parent_id = null;
            foreach($cates as $cate)
            {
                $parent_id[] = $cate->id;
                
            }
            $parent =  implode(',',$parent_id);
            $products = Product::whereIn('cate_id',[$id,$parent])->paginate(3);
            //nếu là cate cha thi wherein id cate con, va cha
        }else{
            $products = Product::where('cate_id',$id)->paginate(3);
        }
        $cate = Category::find($id);
        $cate_id = $id;
        return view('page.category',compact('products','cate','cate_id','brands'));
        
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
        $product_per = ProductProperties::where('product_id',$product_id)->where('size_id',$size_id)->select('quantity')->get()->first();
        $quantity = $product_per->quantity;
        $valid = array('success' => false, 'messages' => array());
      
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
            // if($total_price > 2000000)
            // {
            //     $ship_price = 0;
            // }else{
            //     $ship_price = 50000;
            // }
            $ship_price = 0;
            //Tổng tiền bằng tổng trừ ship 
            $total       = $total_price + $ship_price;
            $total       =  number_format($total);
            $total_price = number_format($total_price);
            $ship_price  = number_format($ship_price);
            
            $valid['success'] = true;
            $valid['messages'] = "Thành công";
            $cart_count  = Cart::count();
            //response
            echo json_encode(
                array( 
                    "product_id"       => "$product_id",
                    "product_name"     => "$product_name",
                    "image_product"    => "$image_product",
                    "product_size"     => "$product_size",
                    "total"            => "$total",
                    "qty"              => "$qty",
                    "price"            => "$price",
                    "ship_price"       => "$ship_price",
                    "total_price"      => "$total_price",
                    "cart_count"       => "$cart_count",
                    'quantity_on_cart' => "$quantity_on_cart",
                    'valid'            => $valid
                )
            );
        }
    }
    public function getShowCart(){
        return view('page.cart');
    }

    public function getShowCheckout(){
        return view('page.checkout');
    }

    public function postAjaxAddCounpon(Request $request){
        $coupon_name = $request->coupon;
        $valid = array('success' => false, 'messages' => array());
        $coupon = Coupon::where('name',$coupon_name)->get()->first();
        
        if(count($coupon) > 0)
        {
            $value             = $coupon->value;
            $coupon_id         = $coupon->id;
            $request->session()->put('coupon',$coupon->id);
            $subtotal          = Cart::subtotal(0,'','');
            $total_down        =  $value * $subtotal;
            $total_price       = $subtotal - $total_down;
            $valid['success']  = true;
            $valid['messages'] = 'Nhập coupon thành công';
            
            $total_down = number_format($total_down);
            $total_price_raw = $total_price;
            $total_price = number_format($total_price);
        }else{
            $total_price = Cart::subtotal(0,'.',',');
            $total_price_raw = Cart::subtotal(0,'','');
            $total_down = 0;
            $valid['success'] = false;
            $valid['messages'] = 'Mã giảm giá không tồn tại';
        }
        echo json_encode(
            array(
                'total_price_raw' => "$total_price_raw",
                'total_price' => "$total_price",
                'total_down'  => "$total_down",
                'valid'       =>  $valid
            )
        );
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
    public function postAjaxRemoveProduct(Request $request){
        $rowId = $request->rowId;
        foreach(Cart::content() as $cart)
        {
            if($cart->rowId == $rowId)
            {
                Cart::remove($rowId);
                echo "Success";
            }else{
                echo "false";
            }
        }
        
    }
    public function postAjaxXulyQuantity(Request $request)
    {
        $rowId = $request->rowId;
        $quantity = $request->quantity;

        foreach(Cart::content() as $cart)
        {
            if($cart->rowId == $rowId)
            {
                $product_id = $cart->id;
                $size_id = $cart->options->size_id;
            }
        }

        // //lấy số lượng sản phẩm có trong giỏ hàng
        $product_per = ProductProperties::where('product_id',$product_id)->where('size_id',$size_id)->select('quantity')->get()->first();
        $p_quantity = $product_per->quantity;
        
        $valid = array('success' => false, 'messages' => array());

         if($quantity > $p_quantity)
         {
            $valid['success'] = false;
            $valid['messages'] = "Số lượng nhập vào quá lớn đề nghị bạn nhập lại";
            echo json_encode(
            array(
                "rowId" => "$rowId",
                "quantity" => "$quantity",
                "valid" => $valid
                )
            );
        }else{
          
            Cart::update($rowId, $quantity);
             foreach(Cart::content() as $row)
            {
                if($row->rowId == $rowId)
                {
                    $row_total = $row->subtotal(0,".",",");
                }
            }

            $valid['success'] = true;
            $valid['messages'] = "Thành công";
            $total_price = Cart::subtotal(0,".",",");
            
            echo json_encode(
                array(
                "rowId" => "$rowId",
                "row_total" => "$row_total",
                'total_price' => "$total_price",
                'valid' => $valid
                )
            );
        }
    }

    public function postAjaxXulyCheckBox(Request $request)
    { 
        $cate_id = $request->cate_id;
        $brand_list = $request->brand_list;

        // check var sortby
        switch ($request->sortby) {
            case 'created-ascending':
                $sort = "id ASC";
                break;
            case 'created-descending':
                $sort = "id DESC";
                break;
            default:
                $sort = "id ASC";
                break;
        }
        //nếu tòn tại brandlist thì cho về mảng
        if(!empty($brand_list)){
    
            $products = Product::where('cate_id',$cate_id)->whereIn('brand_id',$brand_list)->orderByRaw($sort)->paginate(8);
        }else{
            $products = Product::where('cate_id',$cate_id)->orderByRaw($sort)->paginate(8);
        }
        //response for ajax
        return view('page.block_product',compact('products'));
    }
}
