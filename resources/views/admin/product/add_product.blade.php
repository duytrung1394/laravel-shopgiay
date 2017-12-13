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
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="txtName" placeholder="Please Enter Username" />
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="txtPrice" placeholder="Please Enter Password" />
                            </div>
                            <div class="form-group">
                                <label>Intro</label>
                                <textarea class="form-control" rows="3" name="txtIntro"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control" rows="3" name="txtContent"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" name="fImages">
                            </div>
                            <div class="form-group">
                                <label>Product Keywords</label>
                                <input class="form-control" name="txtOrder" placeholder="Please Enter Category Keywords" />
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Product Status</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" checked="" type="radio">Visible
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="2" type="radio">Invisible
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Product Add</button>
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
                               
                                <div class="form-group" id="add-image">
                                    <input type="file" name="image[]" class="form-control input-image upload-1" data-inputid='1'>
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
                if($('#add-image input').length < 9)
                {   
                    var i = $('#add-image input').length + 1;
                    $('#add-image').append("<input type='file' name='image[]' class='form-control input-image upload-"+i+"' data-inputid='"+i+"'/>");
                    $("#preview").append("<img class='box-preview-img img-"+i+"'/>");
                }
            });

            $("#add-image").delegate(".input-image","change",function (event){
                var id = $(this).attr('data-inputid');
                $('#preview .img-'+id).css("visibility","visible")
            $('#preview .img-'+id).attr('src', URL.createObjectURL(event.target.files[0])); 
            });

            $("#del-input").click(function (){
                if($("#add-image input").length>1){
                    var i = $("#add-image input").length;
                    $("#add-image .upload-"+i).remove();
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