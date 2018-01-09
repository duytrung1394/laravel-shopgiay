<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

use App\Brand;
use App\Category;
use App\Size;
use App\Product;
use App\ImageProduct;
use DateTime;
use File;
use Carbon\Carbon;
use App\ProductProperties;
class ProductController extends Controller
{
    public function getAddProduct()
    {
       
    	$cate = Category::all()->toArray();
        $brands = Brand::all();
    	$size = Size::all();
    	return view('admin.product.add_product',compact('cate','size','brands'));
    }

    public function postAddProduct(ProductRequest $request)
    {
        $this->validate($request,[
            "txtName"     => "unique:product,name",
            "txtHinh"     => "required|image",
         ],[
            "txtName.unique"       => "Tên sản phẩm bị trùng",
            "txtHinh.image"        => "Bạn cần chọn hình ảnh",
            "txtHinh.required"     => "Bạn chưa chọn hình đại diện",
        ]);
    	$product = new Product;
        $product->cate_id         = $request->selectParentId;
        $product->brand_id        = $request->selectBrandId;
        $product->name            = $request->txtName;
        $product->slug_name       = str_slug($request->txtName,"-");
        $product->meta_name       = unicode_convert_for_regex($request->txtName);
        $product->description     = $request->txtDescription;
        $product->detail          = $request->txtDetail;
        $product->unit_price      = $request->txtUnitPrice;
        $product->promotion_price = $request->txtPromoPrice; 
        $product->new             = $request->rdoNew;
        $product->created_at      = new DateTime;
        $allowed = array('image/jpg','image/png','image/jpeg');
        if($request->hasFile('txtHinh')){
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if(in_array($hinh->getClientMimeType(),$allowed)){
                if($hinh->move('uploaded/product',$renamed_h)){
                $product->image_product   = $renamed_h;
                }
            }
        }
        if($product->save()){
            $max_id = Product::max('id');
            if($request->hasFile('hinh'))
            {
                
                foreach($request->file('hinh') as $file){

                    $product_image = new ImageProduct;
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
    public function getListProduct()
    {
        $products = Product::orderBy('id','DESC')->get();
      
        return view('admin.product.list_product',compact('products'));
    }

    public function getEditProduct($id)
    {
        $cates = Category::all();
        $product = Product::find($id);
        $brands = Brand::all();
        return view('admin.product.edit_product',compact('product','cates','brands'));
    }
    public function getAddSize($id)
    {
        $sizes = Size::all();

        $product = Product::find($id);
        
        return view("admin.product.add_size", compact('sizes','product'));
    }
    public function postAddSize(Request $request, $id)
    {
        $this->validate($request,[
            "txtQuantity" => "required|numeric"
        ],[
            "txtQuantity.required" => "Bạn chưa nhập số lượng",
            "txtQuantity.numeric"  => "Số lượng phải là số",
           
        ]);
        
        $sizes = ProductProperties::where('product_id',$id)->where("size_id",$request->selectSizeId)->get()->toArray();
        if(count($sizes)>0){
            return redirect("admin/san-pham/size/them/".$id)->with('error','Size đã tồn tại');
        }else{
             $size = new ProductProperties;
            $size->product_id = $id;
            $size->size_id    = $request->selectSizeId;
            $size->quantity   = $request->txtQuantity;
            $size->save();

            return redirect("admin/san-pham/size/them/".$id)->with('message','Thêm size thành công');     
        }
       
    }
    public function postEditProduct(ProductRequest $request, $id){
        if(isset($_POST['ok']))
        {
            $this->validate($request,[
            "txtName" => "unique:product,name,".$id,
        ],[
            "txtName.unique" => "Tên sản phẩm bị trùng",
        ]);

        $product = Product::find($id);
        $product->cate_id         = $request->selectCateID;
        $product->brand_id        = $request->selectBrandId;
        $product->name            = $request->txtName;
        $product->slug_name       = str_slug($request->txtName,"-");
        $product->meta_name       = unicode_convert_for_regex($request->txtName);
        $product->description     = $request->txtDescription;
        $product->detail          = $request->txtDetail;
        $product->unit_price      = $request->txtUnitPrice;
        $product->promotion_price = $request->txtPromoPrice; 
        $product->new             = $request->rdoNew;
        $product->updated_at      = new DateTime;
        $allowed = array('image/jpg','image/png','image/jpeg');
        if($request->hasFile('txtHinh')){
            $hinh      = $request->file('txtHinh');
            $ext_image = $hinh->getClientOriginalExtension();
            $renamed_h = uniqid('_anh',true). "." .$ext_image;
            if(in_array($hinh->getClientMimeType(), $allowed)){
                if($hinh->move('uploaded/product',$renamed_h)){
                $product->image_product   = $renamed_h;
                }
            }
        }
        $product->save();
            if($request->hasFile('hinh'))
            {
                
                foreach($request->file('hinh') as $file){

                    $product_image = new ImageProduct;
                    $ext = $file->getClientOriginalExtension();
                    $renamed = uniqid('_anh',true). "." .$ext;

                    if(in_array($file->getClientMimeType(),$allowed)){
                        if($file->move('uploaded/product',$renamed)){
                            $product_image->name       = $renamed;
                            $product_image->product_id = $id;
                            $product_image->created_at = new DateTime;
                            $product_image->save();
                        }
                    }
                }
            }  
            return redirect("admin/san-pham/sua/".$id)->with('message','Sửa thành công');    
        } 
    }

    public function getEditImage($id)
    {
        $image = ImageProduct::find($id);

        return view('admin.product.edit_image',compact('image'));
    }
   
    public function postEditImage($id, Request $request)
    {

        $image = ImageProduct::find($id);
        $image_name = $image->name;
        $image_path = "uploaded/product/".$image_name;
        if($request->hasFile('txtHinh')){
                $file = $request->file('txtHinh');
                $allowed = array('image/jpg','image/png','image/jpeg');
                $ext = $file->getClientOriginalExtension();
                $renamed = uniqid('_anh'). "." . $ext;
            if(in_array($file->getClientMimeType(),$allowed))
            {
                if($file->move('uploaded/product/',$renamed))
                {
                    $image->name = $renamed;
                    $image->save();
                    if(File::exists($image_path))
                    {
                        File::delete($image_path);
                    }
                }else{
                    return redirect('admin/san-pham/hinh/sua/'.$id)->with('error','Không the upload'); 
                }
            }else{
                return redirect('admin/san-pham/hinh/sua/'.$id)->with('error','Lỗi định dạng file');     
            }
        }
        return redirect('admin/san-pham/hinh/sua/'.$id)->with('message','thanh cong');
    }

    public function postAjaxViewSize(Request $request)
    {
        $product_id = $request->product_id;
        $sizes = ProductProperties::where('product_id',$product_id)->get();
        if(count($sizes) > 0)
        {

            echo "<table>
                <tr>
                    <th style='width: 120px'>Size</th>
                    <th style='width: 120px'>Số lượng</th>
                </tr>";
            if(count($sizes)>0)
            {
                foreach($sizes as $size)
                {
                    echo  "<tr><td>";
                    $size_name = Size::find($size->size_id); 
                    echo $size_name->name."</td><td>";
                    echo $size->quantity."</td></tr>";
                }
            }
            echo "</table> </div>";
        }else{
            echo "Chưa có size cho sản phẩm";
        }
    }
    public function postAjaxDelImage(Request $request)
    {
        $image_id = $request->id;

        $image = ImageProduct::find($image_id);
        $image_name = $image->name;
        $image->delete();
        $image_path = "uploaded/product/".$image_name;
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        echo "true";
    }
    public function postAjaxEditQuantity(Request $request)
    {
        $product_id = $request->product_id;
        $size_id    =  $request->size_id;
        $quantity   = $request->quantity;
        //QueryBuilder udpate table
        $quantity = DB::table('product_properties')->where('product_id',$product_id)->where('size_id',$size_id)->update(['quantity'=>$quantity]);
        echo "true";
    }   

}
