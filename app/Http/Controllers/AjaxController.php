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
use Illuminate\Support\Facades\Auth;
class AjaxController extends Controller
{
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
            $price = number_format($price); // format_price
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

    public function postAjaxFilterPaginate(Request $request)
    {   
        $cate_id = $request->cate_id;
        $brand_list = $request->brand_list;
        $size_list = $request->size_list;
        $price_list = $request->price_list;
        
        $brands = null;
        $sizes = null;
        $itemsOnPage = $request->itemsOnPage;
        // check var sortby
        switch ($request->sortby) {
            case 'created-ascending' :
                $sort = "id ASC";
                break;
            case 'created-descending' :
                $sort = "id DESC";
                break;
            case 'price-ascending' :
                $sort = "price ASC";
                break;
            case 'price-descending' :
                $sort = 'price DESC';
                break;
            //more
            default:
                $sort = "price ASC";
                break;
        }

        //find sản phẩm theo filter
        //Khi không có filter nào được check
        $filter = "";

        // if brand has been checked
        if(!empty($brand_list)){
            //convert to string
            $brand_id = implode(",",$brand_list);
            //nối bộ lọc vào filter
            $filter .= " and brand_id in ($brand_id) ";

            // $products = Product::where('cate_id',$cate_id)->whereIn("brand_id",$brand_list)->orderByRaw($sort)->paginate(4); //old
            $brands = Brand::whereIn('id',$brand_list)->get();
        }
        // if brand has been checked
        if(!empty($size_list)){
            $size_id = implode(',',$size_list);

            $filter .= " and id in (select product_id from product_properties where size_id in ($size_id) and quantity > 0) ";

            //get size for tag
            $sizes = Size::whereIn('id',$size_list)->get();
        }

        if(!empty($price_list)){
            // dd($price_list);
            $filter .= " and (";
            foreach($price_list as $key => $price_node){
                // từ phần tử thứ 2, thì thêm ||
                if($key > 0){
                    $filter .= " || ( unit_price BETWEEN $price_node[price_min] and $price_node[price_max] ) ";
                }else{
                    $filter .= " ( unit_price BETWEEN $price_node[price_min] and $price_node[price_max] ) ";
                }
            }
            $filter .= " ) ";
        }
        // $products =Product::where('cate_id',$cate_id)->whereRaw("brand_id in (1) and id in (select product_id from product_properties where size_id = 1)")->orderByRaw($sort)->paginate(4); //test loc theo size và brand
        $selectRaw = '*, case when promotion_price > 0 then promotion_price else unit_price end as price';

        $products = Product::selectRaw($selectRaw)->whereRaw("cate_id = $cate_id".$filter)->orderByRaw($sort)->paginate($itemsOnPage);
        
        //response ajax
        return view('ajax_result.block_product',compact('products','brands','sizes','price_list'));
    }

    public function postAjaxSearch(Request $request){
        $key_search = $request->key;
        $product = Product::search($key_search)->take(5)->get();

        return view('ajax_result.result_search',compact('product','key_search'));
    }
    public function postAjaxDangnhap(Request $request)
    {
        $email = $request->txtEmail;
        $password = $request->txtPassword;
        $valid = array('success' => false, 'messages' =>array());
        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
            $valid['success'] = true; 
            $valid['messages'] = 'Đăng nhập thành công';
        }else{
            $valid['success'] = false;
            $valid['messages'] = 'Sai email hoặc mật khẩu hoặc là tài khoản của bạn chưa được kích hoạt';
        }

        echo json_encode(
            array(
                'valid' => $valid
            )
        );
    }
    
    public function postAjaxShowBills(Request $request)
    {
        $bill_id = $request->bill_id;
        // lay thong tin hoa don
        $bills = Bills::find($bill_id);
        // chi tiet hoa don
        $bill_detail = $bills->billdetail;

        $customer = Customer::find($bills->customer_id);
      
        return view('ajax_result.block_list_bill',compact('bills','bill_detail','customer'));
    }
}
