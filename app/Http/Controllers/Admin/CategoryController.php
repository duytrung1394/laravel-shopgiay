<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use DateTime;
class CategoryController extends Controller
{
    public function getIndexAdmin(){
        return view('admin.index');
    }
    public function getAddCate()
    {

    	$cate = Category::all()->toArray();
    	
    	return view('admin.category.add_cate',compact('cate'));
    }

    public function postAddCate(Request $request)
    {
    	$request->validate([
    		"txtCateName" => "required",
            "txtFullName" => "required",
    	],[
    		"txtCateName.required" => "Bạn chưa nhập cate name",
            "txtFullName.required" => "Bạn chưa nhập full cate name"
    	]);

        $cate             = new Category;
        $cate->name       = $request->txtCateName;
        $cate->full_name  = $request->txtFullName;
        $cate->parent_id  = $request->selectParentId;
        $cate->created_at = new DateTime;
    	$cate->save();

    	return redirect(route('themdanhmuc'))->with("message","Thêm thành công");
    }

    public function getListCate()
    {
        $cates = Category::all();
        
        return view("admin.category.list_cate",compact('cates'));
    }

    public function getEditCate($id)
    {
        $cate = Category::all()->toArray();
        
        $item = Category::find($id);
   
        return view("admin.category.edit_cate",compact('cate','item'));
    }

    public function postEditCate($id , Request $request)
    {
        $request->validate([
            "txtCateName" => "required",
            "txtFullName" => "required",
        ],[
            "txtCateName.required" => "Bạn chưa nhập cate name",
            "txtFullName.required" => "Bạn chưa nhập full cate name"
        ]);

        $cate             = Category::find($id);
        $cate->name       = $request->txtCateName;
        $cate->full_name  = $request->txtFullName;
        $cate->parent_id  = $request->selectParentId;
        $cate->updated_at = new DateTime;
        $cate->save();

        return redirect('admin/danh-muc/sua/'.$id)->with("message","Sửa thành công");
    }

    public function getDelCate($id)
    {
        $count = Category::where('parent_id',$id)->count();
        if($count == 0)
        {
            $cate = Category::find($id);
            $cate->delete();
            return redirect('admin/danh-muc/danh-sach')->with('message','xóa thành công');
        }else{
            echo "<script type='text/javascript'>
                alert('Bạn không thể xóa chuyên mục này');
                window.location ='";
           echo route('listdanhmuc');
            echo "'
            </script>";
         
        }
    }
}
