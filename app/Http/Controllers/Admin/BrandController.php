<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Brand;
class BrandController extends Controller
{
    public function getAddBrand()
    {
    	return view('admin.brand.add_brand');
    }
    public function postAddBrand(Request $request)
    {
    	$this->validate($request,[
    		"txtBrandName" => "required|unique:brand,name",
    		"txtDescription" => "required",
    	],[
    		"txtBrandName.required" => "Bạn chưa nhập tên thương hiệu",
    		"txtBrandName.unique" => "Thương hiệu đã tồn tại",
    		"txtDescription.required" => "Bạn chưa nhập mô tả"
    	]);

    	$brand = new Brand;
    	$brand->name = $request->txtBrandName;
    	$brand->slug_name = str_slug($request->name);
    	$brand->description = $request->txtDescription;
    	$brand->save();
    	return  redirect('admin/thuong-hieu/them')->with('message',"Thêm thành công");
    }

    public function getListBrand()
    {
    	$brands = Brand::all();
    	return view('admin.brand.list_brand',compact('brands'));
    }

    public function getEditBrand($id)
    {
    	$brand = Brand::find($id);
    	return view('admin.brand.edit_brand',compact('brand'));
    }
    public function postEditBrand($id, Request $request)
    {
    	$this->validate($request,[
    		"txtBrandName" => "required|unique:brand,name,".$id,
    		"txtDescription" => "required",
    	],[
    		"txtBrandName.required" => "Bạn chưa nhập tên thương hiệu",
    		"txtBrandName.unique" => "Thương hiệu đã tồn tại",
    		"txtDescription.required" => "Bạn chưa nhập mô tả"
    	]);

    	$brand = Brand::find($id);
    	$brand->name = $request->txtBrandName;
    	$brand->slug_name = str_slug($request->name);
    	$brand->description = $request->txtDescription;
    	$brand->save();
    	return redirect("admin/thuong-hieu/sua/".$id)->with('message','Sửa thành công');
    }
    public function getDelBrand($id)
   {
        $cate = Brand::find($id);
        $cate->delete();
        return redirect('admin/thuong-hieu/danh-sach')->with('message','Xóa thành công');
   }
}
