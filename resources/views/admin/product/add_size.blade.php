@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Size sản phẩm
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                             @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning!!</strong>
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                            @endif
                            @if(session('message'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Success</strong>
                                    {{session('message')}}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Warning</strong>
                                    {{session('error')}}
                                </div>
                            @endif
                        <form action="" method="POST">
                            <div  class="form-group">
                                <label>Tên sản phẩm</label> 
                                <h4>
                                    {{$product->name}}
                                </h4>
                            </div>
                            <div class="form-group">
                               <label>Danh sách size đã có</label>
                               <table>
                                    <tr>
                                       <th style="width: 120px">Size</th>
                                       <th style="width: 120px">Số lượng</th>
                                    </tr>
                                    @if(count($product->product_properties)>0)
                                    @foreach($product->product_properties as $p_product)
                                    <tr>
                                        <td>
                                         {{$p_product->size->name}}</td>
                                        <td>{{$p_product->quantity}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                  
                               </table>
                            </div>
                            
                            <div class="form-group">
                                <label>Tên size</label>
                                <select class="form-control" name="selectSizeId">
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="txtQuantity" placeholder="Nhập tên danh mục" value="{!!old('txtQuantity')!!}"/>
                            </div> 
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Hủy</button>
                            <a href="admin/san-pham/sua/{{$product->id}}" class="btn btn-default">Trở về</a>
                            {{csrf_field()}}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection