<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
class CouponController extends Controller
{
    //
    public function getAddCoupon()
    {
    	return view('admin.coupon.add_coupon');
    }
     public function getListCoupon()
    {
    	$coupons = Coupon::all();
    	return view('admin.coupon.list_coupon',compact('coupons'));
    }
    public function postAddCoupon(Request $request)
    {
    	$this->validate($request, [
    		'txtCouponName' => 'required|unique:coupon,name',
    		'txtCouponValue' => 'numeric|between:0,1'
    	],[
    		'txtCouponName.required' => 'Bạn phải nhập vào tên Coupon',
    		'txtCouponName.unique' => 'Tên coupon đã tồn tại',
    		'txtCouponValue.numeric' => 'Bạn phải nhập vào số',
    		'txtCouponValue.between' => 'Bạn phải nhập số có giá trị từ 0 tới 1'
    	]);

    	$coupon = new Coupon;
    	$coupon->name = $request->txtCouponName;
    	$coupon->value = $request->txtCouponValue;
    	$coupon->save();

    	return redirect('admin/coupon/them')->with('message','Thêm thành công');
    }
    public function getEditCoupon($id)
    {
    	$coupon = Coupon::find($id);
    	return view('admin.coupon.edit_coupon',compact('coupon'));
    }

    public function postEditCoupon($id, Request $request)
    {
    	$this->validate($request, [
    		'txtCouponName' => 'required|unique:coupon,name,'.$id,
    		'txtCouponValue' => 'numeric|between:0,1'
    	],[
    		'txtCouponName.required' => 'Bạn phải nhập vào tên Coupon',
    		'txtCouponName.unique' => 'Tên coupon đã tồn tại',
    		'txtCouponValue.numeric' => 'Bạn phải nhập vào số',
    		'txtCouponValue.between' => 'Bạn phải nhập số có giá trị từ 0 tới 1'
    	]);

    	$coupon = Coupon::find($id);
    	$coupon->name = $request->txtCouponName;
    	$coupon->value = $request->txtCouponValue;
    	$coupon->save();

    	return redirect('admin/coupon/sua/'.$id)->with('message','Sửa thành công');
    }

    public function getDelCoupon($id)
    {
    	$coupon = Coupon::find($id);
    	$coupon->delete();

    	return redirect('admin/coupon/danh-sach')->with('message','Xóa thành công');
    }
}
