@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sản Phẩm
                        <small>Sửa</small>
                    </h1>
                </div>
                <a href="admin/san-pham/danh-sach" class="btn btn-default">Trở về</a>
                <!-- /.col-lg-12 -->
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="col-lg-7" style="padding-bottom:100px">
                @if(count($errors)>0)
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    @foreach($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
                    </div>
                @endif
                @if(!empty(session('message')))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{session('message')}}
                    </div>
                @endif
                        <div class="form-group">
                            <label>Danh mục cha</label>
                            <select class="form-control" name="selectCateID">
                                <?php 
                                $cate_id = $product->cate_id; 
                                listcate($cates, 0, $str = "", $cate_id ) ?>
                            </select>
                        </div>
                         <div class="form-group">
                                <label>Thương hiệu</label>
                                <select class="form-control" name="selectBrandId">
                                    @foreach($brands as $brand)
                                        <option value='{{$brand->id}}' @if($brand->id == $product->brand_id) selected @endif >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input class="form-control" name="txtName" placeholder="Nhập tên đầy đủ" value="{{$product->name}}"/>
                        </div> 
                        <div class="form-group">
                            <label>Hình đại diện</label>
                            <div style="margin: 10px; "><img src="uploaded/product/{{$product->image_product}}" width="150px" height="100px" style="border-radius: 4px"></div>
                            <input type="file" class="form-control" name="txtHinh"  />
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtDescription">{{$product->description}}</textarea>
                        </div> 
                        <div class="form-group">
                            <label>Chi tiết</label>
                            <textarea class="form-control ckeditor" rows="3" id="editor1" value="" name="txtDetail">{{$product->detail}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Đơn giá</label>
                            <input class="form-control" name="txtUnitPrice" placeholder="Nhập đơn giá" value="{{$product->unit_price}}"/>
                        </div> 
                        <div class="form-group">
                            <label>Giá khuyến mãi</label>
                            <input class="form-control" name="txtPromoPrice" placeholder="Nhập giá khuyến mãi" value="{{$product->promotion_price}}"/>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <label class="radio-inline">
                                <input name="rdoNew" value="1" @if($product->new == 1) checked @endif type="radio">Mới
                            </label>
                            <label class="radio-inline">
                                <input name="rdoNew" value="0" type="radio" @if($product->new == 0) checked="" @endif>Cũ
                            </label>
                        </div>
                    <button type="submit" class="btn btn-default" name='ok'>Lưu lại</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>
                <div class="col-lg-5" >

                    <div class="row" style="margin: 20px 0px; padding-top: 10px; border-top: 1px solid #ccc;">
                        <button type="button" class="btn btn-primary" id="btn-add-file">Thêm hình</button>
                        <button type="button" class="btn btn-warning" id="reset-image" >Hủy</button>
                        <button type="button" class="btn btn-danger" id="del-input" name='del'>xóa</button>
                    </div>
                    <div class="row">
                        <div class ="col-lg-7">
                            <div class='form-group' id="divUpload">
                                <input type='file' class='form-control upload-1 file-upload' name='hinh[]' data-inputid="1" >
                            </div>
                        </div>
                        <div class="col-lg-5" id="preview">
                            <img class='box-preview-img img-1'/>
                        </div>
                    </div>
                 {{csrf_field()}}
                <form>
                    <div>
                        <h4>Danh sách hình ảnh</h4>
                        <div id="list-image">
                            @foreach($product->product_image as $p_image)
                            <div class="row item-image item-image-{{$p_image->id}}">
                                <div class="col-md-5 col-lg-6" >
                                    <img src="uploaded/product/{{$p_image->name}}" style="border-radius: 4px"/>
                                    <a id='del_img' class="btn btn-danger btn-circle icon_del" data-imageid='{{$p_image->id}}'><i class="fa fa-times"></i></a>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <p><a href="admin/san-pham/hinh/sua/{{$p_image->id}}">Sửa hình ảnh</a>
                                </div>
                            </div>
                            @endforeach 
                        </div>
                    </div>
                    
                <div style="border-top: 1px solid #ccc; padding: 15px 0px;"><a type="button" href="admin/san-pham/size/them/{{$product->id}}" class="btn btn-primary">Thêm Size</a>
                    </div>
                    <div style="border-top: 1px solid #ccc; padding-top: 10px;">
                        <h4>Danh sách size</h4>
                        <table id="list_size">
                            <tr>
                                <th style="width: 100px;">Size</th>
                                <th style="width: 100px">Số lượng</th>
                                <th style="width: 80px">Sửa</th>
                                <th style="width: 80px">Xóa</th>
                            </tr>
                            @foreach($product->product_properties as $properties)
                                <tr>
                                    <td>
                                    <?php $size = App\Size::find($properties->size_id);
                                        echo $size->name;
                                    ?>
                                    </td> 
                                    <td><input type="text" name="txtQuantity" value="{{$properties->quantity}}" class='quantity-{{$properties->size_id}}'></td>
                                    <td><a href="javascript:void(0)" class='save-quantity' data-pid='{{$product->id}}' data-sizeid='{{$properties->size_id}}'><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Lưu</a></td>
                                    <td><a href="javascript:void(0)" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Xóa</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            // them input file
            $("#btn-add-file").click(function ()
            {   
                if($('#divUpload input').length < 9)
                {   
                    var i = $('#divUpload input').length + 1;
                    $("#divUpload").append("<input type='file' class='form-control upload-"+i+" file-upload' name='hinh[]'  data-inputid='"+i+"' >");                    
                    $("#preview").append("<img class='box-preview-img img-"+i+"'/>");
                }
            });
            //hien hinh anh preview khi chọn hinh
            $("#divUpload").delegate(".file-upload","change",function (event){
                var id = $(this).attr('data-inputid');
                $('#preview .img-'+id).css("visibility","visible")
                $('#preview .img-'+id).attr('src', URL.createObjectURL(event.target.files[0])); 
            });

            $("#del-input").click(function (){
                if($("#divUpload input").length>1){
                    var i = $("#divUpload input").length;
                    $("#divUpload .upload-"+i).remove();
                    $("#preview .img-"+i).remove();
                }
            });

            $("#reset-image").click(function ()
            {
                $(".box-preview-img").css("visibility","hidden");

                $(".file-upload").val("");

            });

            //xóa hình ảnh
            $('.icon_del').click(function () {
                var id = $(this).attr('data-imageid');

                $.ajax({
                    url: "admin/ajax/del-image",
                    type: "post",
                    data: "id="+id,
                    async: true,
                    success:function(data){
                       if(data=='true'){
                            $('.item-image-'+id).fadeOut();
                       }
                    }
                });
            });
            //sửa số lượng sản phẩm
            $(".save-quantity").click(function (){
                var product_id = $(this).attr('data-pid');
                var size_id = $(this).attr('data-sizeid');
                var quantity = $('.quantity-'+size_id).val();

                $.ajax({
                    url: "admin/ajax/edit-quantity",
                    type: "post",
                    data: "product_id="+product_id+"&size_id="+size_id+"&quantity="+quantity,
                    async: true,
                    success:function(data)
                    {
                        if(data === "true"){
                            alert("Sửa số lượng sản phẩm thành công");
                        }
                    }
                });
            });

        });
    </script>
@endsection