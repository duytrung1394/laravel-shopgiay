@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Mã giảm giá
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-12" style="padding-bottom:120px">
                             @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                            @endif
                             @if(session('message'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{session('message')}}
                                </div>
                            @endif
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Tên Mã giảm giá</label>
                                <input class="form-control" name="txtCouponName" placeholder="Nhập tên mã giảm giá" value="{!! $coupon->name!!}"/>
                            </div>  
                            <div class="form-group">
                                <label>Tỷ lệ</label>
                                <input class="form-control" name="txtCouponValue" placeholder="Tỷ lệ là số lớn hơn 0 và bé hơn 1" value="{!!$coupon->value!!}"/>
                            </div> 
                            <button type="submit" class="btn btn-default">Lưu</button>
                            <button type="reset" class="btn btn-default">Hủy</button>
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