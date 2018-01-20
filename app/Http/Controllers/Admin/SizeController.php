<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Size;
class SizeController extends Controller
{
    public function getAddSizes()
    {
    	return view('admin.size.add_size');
    }
    public function postAddSizes(Request $request)
    {
    	$this->validate($request, 
    	[
    		"txtSizeName" => 'required|unique:size,name'
    	],[
    		"txtSizeName.required" => "Bạn phải nhập tên size",
    		"txtSizeName.unique" => "Size đã tồn tại"
    	]);

    	$size = new Size;
    	$size->name = $request->txtSizeName;
    	$size->save();

    	return redirect('admin/size/them')->with('message','Thêm thành công');

    }
    public function getEditSizes($id)
    {
    	$size = Size::find($id);
    	return view('admin.size.edit_size',compact('size'));
    }
     public function postEditSizes($id,Request $request)
    {
    	$this->validate($request, 
    	[
    		"txtSizeName" => 'required|unique:size,name,'.$id
    	],[
    		"txtSizeName.required" => "Bạn phải nhập tên size",
    		"txtSizeName.unique" => "Size đã tồn tại"
    	]);

    	$size = Size::find($id);
    	$size->name = $request->txtSizeName;
    	$size->save();

    	return redirect('admin/size/sua/'.$id)->with('message','Sửa thành công');

    }
    
    public function getListSizes()
    {
    	$sizes = Size::all();
    	return view('admin.size.list_size',compact('sizes'));
    }
   
   public function getDelSizes($id)
   {
        $cate = Size::find($id);
        $cate->delete();
        return redirect('admin/size/danh-sach')->with('message','Xóa thành công');
   }
}
