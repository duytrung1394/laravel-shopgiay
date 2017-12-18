<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProductRequest;

use App\Category;
use App\Size;
use App\Product;
use App\ImageProduct;
use DateTime;

class ProductController extends Controller
{
    public function getAddProduct()
    {
       
    	$cate = Category::all()->toArray();

    	$size = Size::all();
    	return view('admin.product.add_product',compact('cate','size'));
    }

    public function postAddProduct(Request $request)
    {
    	$product = new Product;
        $product->cate_id         = $request->selectParentId;
        $product->name            = $request->txtName;
        $product->slug_name       = str_slug($request->txtName,"-");
        $product->meta_name       = unicode_convert_for_regex($request->txtName);
        $product->description     = $request->txtDescription;
        $product->detail          = $request->txtDetail;
        $product->unit_price      = $request->txtUnitPrice;
        $product->promotion_price = $request->txtPromoPrice; 
        $product->new             = $request->rdoNew;
        $product->created_at      = new DateTime;
        if($request->hasFile('txtHinh')){
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if($hinh->move('uploaded/product',$renamed_h)){
                $product->image_product   = $renamed_h;
             }
        }
        if($product->save()){
            $max_id = Product::max('id');
            if($request->hasFile('hinh'))
            {
                
                foreach($request->file('hinh') as $file){

                    $product_image = new ImageProduct;

                    $allowed = array('image/jpg','image/png','image/jpeg');
                    
                    $ext = $file->getClientOriginalExtension();
                    $renamed = uniqid('_anh',true). "." .$ext;

                    if(in_array($file->getClientMimeType(),$allowed)){
                        if($file->move('uploaded/product',$renamed)){
                            $product_image->name       = $renamed;
                            $product_image->product_id = $max_id;
                            $product_image->created_at = new DateTime;
                            $product_image->save();
                        }
                    }
                }
            }
            
        }
        return redirect("admin/san-pham/them")->with("message","Thêm sản phẩm thành công");

    }
}
