@extends('admin.layout.master')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Chuyên mục</th>
                                <th>Date</th>
                                <th>Đơn giá</th>
                                <th>Sale</th>
                                <th>Status</th>
                                <th>Size</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="odd gradeX" align="center">
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->full_name}}</td>
                                <td><?php Carbon\Carbon::setLocale('vi') ; //dùng để đinh nghĩa time
                                    if(Carbon\Carbon::createFromTimestamp(strtotime($product->created_at))->diffInHours() >= 24)
                                    {
                                        $date =  $product->created_at;
                                    }
                                    else {
                                        $date =  Carbon\Carbon::createFromTimestamp(strtotime($product->created_at))->diffforHumans();
                                    }
                                    ?>
                                    {{$date}}
                                    </td>
                                <td>{{$product->unit_price}}</td>
                                <td>{{$product->promotion_price}}</td>
                                <td>Hiện</td>
                                <td class="center"><i class="fa fa-plus-square fa-fw"></i> <a href=""  class="view-size"  data-toggle="modal" data-target="#myModal"  data-viewid='{{$product->id}}'>Xem</a></td>
                                
                                <td class="center"  ><i class="fa fa-trash-o fa-fw"></i> <a href="javascript:void(0)"  >Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/san-pham/sua/{{$product->id}}">Sửa</a></td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
                <!-- Button trigger modal -->
               

                <!-- Modal -->
                <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Bảng size</h4>
                      </div>
                      <div class="modal-body">
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            
            $('.view-size').click(function (){
                var id = $(this).attr('data-viewid');

                $.ajax({
                    url: "admin/ajax/view-size",
                    type: "post",
                    data: "product_id="+id,
                    async: true,
                    success:function(data)
                    {  
                        $(".modal-body").html(data);
                    }
                 });
             });
        });
        
    </script>
@endsection