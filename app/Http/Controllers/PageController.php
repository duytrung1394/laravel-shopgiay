<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProductProperties;
use App\Category;
use App\ImageProduct;
use App\Size;
use App\Coupon;
use \Cart;
use Session;
use App\Customer;
use App\Bills;
use App\DetailBill;
use App\Brand;
use App\User;
use Mail;
use App\UserActivation;
use App\Jobs\SendActivationMail;
use App\Jobs\SendBillInfoMail;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UserRequest;
use App\Notifications\checkoutNoti;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
   protected $userActivation;

	public function __construct(UserActivation $userActivation)
	{	
        //truyyền viewshare . loai san pham tới kahcs mọi trang trong page
		$cateShare = Category::get()->toArray();
        view()->share(['cateShare'=>$cateShare]);
        $this->userActivation = $userActivation;
	}
    public function getIndexPage()
    {
    	$new_product = Product::where('new',1)->select('id','name','slug_name','image_product','unit_price','promotion_price','new')->limit(5)->orderBy('id','desc')->get();
    	
    	$sale_product = Product::where('promotion_price','>',0)->select('id','name','slug_name','image_product','unit_price','promotion_price','new')->limit(5)->orderBy('id','desc')->get();
    
    	return view('page.index',compact('new_product','sale_product'));
    }
    public function getCategory($id, Request $request)
    {   
        $cate = Category::find($id);
        if(!empty($cate)){
            // lay cac cate con cua cate_hientai
            $cates_child = Category::where('parent_id',$id)->get();
            // kiem tra ton tai cate cha khong
            $cate_parent = Category::find($cate->parent_id);
            $brands = Brand::all();
            $sizes = Size::all();
            $cate_id = $id;
            $selectRaw = '*, case when promotion_price > 0 then promotion_price else unit_price end as price';
            if(count($cates_child) > 0 )
            {       
                $children_id = null;
                foreach($cates_child as $cate_c)
                {
                    $children_id[] = $cate_c->id;
                    
                }
                //nếu là cate cha thi wherein id cate con, va cha
                $children =  implode(',',$children_id);
                $products = Product::whereIn('cate_id',[$id,$children])->select(DB::raw($selectRaw))->orderBy('price','ASC')->paginate(8);
               
            }else{
                $products = Product::where('cate_id',$id)->select(DB::raw($selectRaw))->orderBy('price','ASC')->paginate(8);
            }
            if(!empty($cate_parent)){
                return view('page.category',compact('products','cate','cate_id','brands','sizes','cate_parent'));
            }
            return view('page.category',compact('products','cate','cate_id','brands','sizes'));
        } else {
            return redirect(route('trang-chu'));
        }
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

    public function postCheckout(CustomerRequest $request){
        
        //Kiêm tra xem số lượng mỗi sản phẩm có còn trong kho hàng nữa không
        $flag = true;
        $list_soil_out = "";
        foreach(Cart::content() as $row)
        {
            $rowId = $row->rowId;
            $product_per = ProductProperties::where('product_id',$row->id)->where('size_id',$row->options->size_id)->select('quantity')->get()->first();
            $quantity_repository = $product_per->quantity;
            //Nếu số lượng trong kho bằng 0 thì xóa sản phẩm đó ra khỏi cart
            if($quantity_repository == 0){
                $size = Size::find($row->options->size_id);
                $size_name = $size->name;
                $list_soil_out .= " ".$row->name." size: ".$size_name." đã hết hàng<br/>";
                $flag = false;
                Cart::remove($rowId);
            }      
            //nếu số lượng trong cart lớn hơn kho     
            else if($row->qty > $quantity_repository)
            {
                $size = Size::find($row->options->size_id);
                $size_name = $size->name;
                $list_soil_out .= " ".$row->name." size: ".$size_name." còn ".$quantity_repository." sản phẩm<br/>";
                $flag = false;
                //update lại số lượng sản phẩm trong cart bằng số lượng trong kho.
                Cart::update($rowId,['qty'=>$quantity_repository]);
            }
        }
        //nếu có những sản phẩm đã hết, hoặc số lượng ít hơn lựa chọn thì thông báo cho người dùng
        if($flag == false){
            return redirect('thanh-toan')->with('loi',"Bạn vui lòng kiểm tra lại giỏ hàng: <br/>".$list_soil_out);
        }
        else{
            $customer = new Customer;
            $customer->email      = $request->txtEmail;
            $customer->first_name = $request->txtFirstName;
            $customer->last_name  = $request->txtLastName;
            $customer->gender     = $request->txtGender;
            $customer->address    = $request->txtAddress;
            $customer->phone      = $request->txtPhone;
            if(Auth::check()) { $customer->user_id = Auth::user()->id;} 
            if($customer->save())
            {   //lưu thonong tin dơn hàng
                $customer_id       = Customer::max('id');   
                $bill = new Bills;
                $bill->customer_id = $customer_id;

                $total_price = Cart::subtotal(0,'','');

                $coupon_value = 0; //set coupon defult
                if(session('coupon'))
                {
                    //Kiểm tra xem có nhập mã giảm giá không
                    $bill->coupon_id = session('coupon');
                    $coupon = Coupon::find(session('coupon'));
                    $coupon_value = $coupon->value;
                }

                $total_price -= $total_price * $coupon_value;

                $bill->total_price = $total_price;
                if($bill->save())
                {   //lưu thông tin chi tiết đơn hàng
                    $bill_id  = Bills::max('id');
                    foreach(Cart::content() as $cart)
                    {
                        $detail_bill             = new DetailBill;
                        $detail_bill->bill_id    = $bill_id;
                        $detail_bill->product_id = $cart->id;
                        $detail_bill->size_id    = $cart->options->size_id;
                        $detail_bill->quantity   = $cart->qty;
                        $detail_bill->unit_price = $cart->price;
                        $price      = $cart->subtotal(0,'','');
                        $price     -= $price * $coupon_value; 
                        $detail_bill->sub_price      =  $price;
                        $detail_bill->save();

                        $product_p = ProductProperties::where('product_id',$cart->id)->where('size_id',$cart->options->size_id)->select('quantity')->get()->first();
                        $quantity = $product_p->quantity;
                        $quantity_remain = $quantity - $cart->qty;

                        //cập nhật lại số lượng hàng trong kho
                        $quantity = DB::table('product_properties')->where('product_id',$cart->id)->where('size_id',$cart->options->size_id)->update(['quantity'=>$quantity_remain]);
                        
                    }
                    dispatch(new SendBillInfoMail($customer, Cart::content(), $total_price, $coupon_value));
                    // send notifications
                    $users = User::where('level', 2)->get();
                    
                    $when = Carbon::now()->addSeconds(10);

                    $bill = Bills::find($bill_id);
                    
                    // send notification
                    \Notification::send($users, (new checkoutNoti($bill))->delay($when));

                    Cart::destroy();
                    session()->forget('coupon');
                    return redirect('thanh-toan')->with('success',"Thanh toán thành công. Bạn có thể kiểm tra email thanh toán để xem đơn hàng, Nhấp vào <a href='". route('trang-chu')."' style='color:#333' >đây</a> để về trang chủ");
                }else{
                    return redirect('thanh-toan')->with('loi',"Không thể lưu lại thông tin đơn hàng");
                }
            }else{
                 return redirect('thanh-toan')->with('loi',"Không thể lưu lại thông tin khách hàng");
            }
        }   
    }
   
    public function getDangKy()
    {
        if(Auth::check()){
            return redirect('/');
        }
        return view('page.register');
    }
    public function postDangKy(UserRequest $request)
    {
        $this->validate($request,[
            'txtEmail' => 'unique:users,email'
        ],[
            "txtEmail.unique" => "Email của bạn đã tồn tại"
        ]);
         if($request->txtPass != $request->txtConfirmPass){
            return redirect('dang-ky')->with('loi','Mật khẩu không trùng khớp');
        }else{
            $user = new User;
            $user->first_name = $request->txtFirstName;
            $user->last_name  = $request->txtLastName;
            $user->email      = $request->txtEmail;
            $user->password   = bcrypt($request->txtPass);
            $user->save();
            $token = $this->userActivation->createActivation($user);
            $activation_link = route('activation', $token);
            // dispatch jobs
            dispatch(new SendActivationMail($user, $activation_link));
            return redirect('dang-ky')->with('thongbao',"Đăng kí thành công. Bạn vui lòng kiểm tra email để kích hoạt tài khoản");
        }
    }

    public function getActivationUser($token){
        // kiểm tra token có tồn tại không
        $activation = $this->userActivation->getActivationByToken($token);
        if($activation){
            $user = User::find($activation->user_id);
            $user->active = 1;
            $user->save();
            auth()->login($user); // login
            $this->userActivation->deleteActivation($token);
        }
        return redirect( route('trang-chu'));
    }
    public function getDangXuat(){
        if(Auth::check()){
            Auth::logout();    
        }
        return redirect('/');
    }

    public function getUserProfile(){
        return view('page.user_profile');
    }
    public function postEditProfile(CustomerRequest $request){
        $id = Auth::user()->id;
        $this->validate($request,[
            'txtEmail' => 'unique:users,email,'.$id
        ],[
            "txtEmail.unique" => "Email của bạn đã tồn tại"
        ]);
        $user = User::find($id);
        $user->email      = $request->txtEmail;
        $user->first_name = $request->txtFirstName;
        $user->last_name  = $request->txtLastName;
        $user->gender     = $request->txtGender;
        $user->address    = $request->txtAddress;
        $user->phone      = $request->txtPhone;
        $user->save();

        return redirect(route('user.profile'))->with('success','Thành công');
    }

    public function getChangePassword(){

        return view('page.password');

    }
    public function PostChangePassword(Request $request){
       $this->validate($request, [
            "txtOldPassword" => "required",
            "txtNewPassword" => "required|min:6",
            "txtConfirmPass" => "required"
       ],[
            "txtOldPassword.required" => "Bạn phải nhập mật khẩu cũ",
            "txtNewPassword.required" => "Bạn phải nhập mật khẩu mới",
            "txtNewPassword.min" => "Mật khẩu mới phải có ít nhất 6 kí tự",
            "txtConfirmPass.required" => "Bạn phải nhập lại mật khẩu mới",
       ]);
       if(Hash::check($request->txtOldPassword, Auth::user()->password)){
           if($request->txtNewPassword == $request->txtConfirmPass){
               $user = User::find(Auth::user()->id);
               $user->password = bcrypt($request->txtNewPassword);
               $user->save();
               return redirect(route("get.password"))->with('success','Đổi mật khẩu thành công');
           }else{
               return redirect(route("get.password"))->with('error','Mật khẩu confirm phải trùng khớp');
           }
       }else{
           return redirect(route("get.password"))->with('error','Mật khẩu cũ không chính xác');
       }
    }
    public function getLogin(){
        if(Auth::check()){
            return redirect(route('trang-chu'));
        }else{
            return view('page.login');
        }
    }
    public function postLogin(Request $request){
        $this->validate($request, [
            "txtEmail" => "required|email",
            "txtPassword" => "required"
        ],[
            "txtEmail.required" => "Bạn phải nhập email",
            "txtEmail.required" => "Bạn phải nhập email",
            "txtPassword.required" => "Bạn phải nhập mật khẩu"
        ]);
        $credentials = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'active' => 1
        ];
        if(Auth::attempt($credentials)){
            return redirect()->back();
        }else{
            return redirect(route('get.login'))->with('error','Sai email, mật khẩu hoặc tài khoản của bạn chưa được kích hoạt');
        }
    }
    public function getListBill(){
        // get list bill of user 
        $customers = Customer::where('user_id',Auth::user()->id)->paginate(5);

        return view('page.list_bill',compact('customers'));
        
    }
}
