@extends("admin.layout.master")
@section("content")
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>Add</small>
                        </h1>
                    </div>

                    <!-- /.col-lg-12 -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-7" style="padding-bottom:120px">
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
                    <a href="admin/san-pham/danh-sach" class="btn btn-default">Trở về</a>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select class="form-control" name="selectParentId">
                                    <?php listcate($cate, 0, $str = "", old('selectParentId') ) ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu</label>
                                <select class="form-control" name="selectBrandId">
                                    @foreach($brands as $brand)
                                        <option value='{{$brand->id}}'>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="txtName" placeholder="Nhập tên đầy đủ" value="{{old('txtName')}}"/>
                            </div> 
                            <div class="form-group">
                                <label>Hình đại diện</label>
                                <input type="file" class="form-control" name="txtHinh"  />
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtDescription">{{old('txtDescription')}}</textarea>
                            </div> 
                            <div class="form-group">
                                <label>Chi tiết</label>
                                <textarea class="form-control ckeditor" rows="3" id="editor1" name="txtDetail" >{{old('txtDetail')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Đơn giá</label>
                                <input class="form-control" name="txtUnitPrice" placeholder="Nhập đơn giá" value="{{old('txtUnitPrice')}}"/>
                            </div> 
                            <div class="form-group">
                                <label>Giá khuyến mãi</label>
                                <input class="form-control" name="txtPromoPrice" placeholder="Nhập giá khuyến mãi" value="{{old('txtPromoPrice')}}"/>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <label class="radio-inline">
                                    <input name="rdoNew" value="1" checked="" type="radio">Mới
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoNew" value="2" type="radio">Cũ
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                            <div class="col-lg-5" >
                                <div class="row" style="margin-bottom: 30px">
                                     <button type="button" class="btn btn-primary" id="btn-add-file">Thêm hình</button>
                                     <button type="button" class="btn btn-warning" id="reset-image" >reset</button>
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
                                
                            </div>
                    {{csrf_field()}}
                    <form>
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
            $("#btn-add-file").click(function ()
            {   
                if($('#divUpload input').length < 9)
                {   
                    var i = $('#divUpload input').length + 1;
                    $("#divUpload").append("<input type='file' class='form-control upload-"+i+" file-upload' name='hinh[]'  data-inputid='"+i+"' >");                    
                    $("#preview").append("<img class='box-preview-img img-"+i+"'/>");
                }
            });

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

                $(".input-image").val("");

            });
        });
    </script>
@endsection