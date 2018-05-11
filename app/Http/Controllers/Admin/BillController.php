<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Bills;
use App\DetailBill;
class BillController extends Controller
{
   	public function getListBill()
   	{
   		$bills = Bills::all();

   		return view('admin.bill.list_bill',compact('bills'));
   	}
   	public function getDetailBill($id)
   	{
   	    $product_items = DetailBill::where('bill_id',$id)->get();
        $bill = Bills::find($id);
        $customer = Customer::find($bill->customer_id);
   		return view('admin.bill.detail_bill',compact('bill','product_items','customer'));
   	}

      public function getDelBill($id)
      {
         $bill = Bills::find($id);
         $bill->delete();
         return redirect('admin/don-hang/danh-sach');
      }

      public function getDelDetailBill($id)
      {
         $bill = DetailBill::find($id);
         $bill->delete();
         return redirect('admin/don-hang/danh-sach');
      }
}
