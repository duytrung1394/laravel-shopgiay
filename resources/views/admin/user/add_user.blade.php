@extends('admin.layout.master')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning!!</strong><br>
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        <!-- In Thông báo -->
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{session('thongbao')}}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning</strong>
                                {{session('loi')}}
                            </div>
                        @endif
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="txtFirstName" placeholder="Điền vào họ User" value="{!! old('txtFirstName') !!}"/>
                            </div>
                            <div class="form-group">
                                <label>Họ</label>
                                <input class="form-control" name="txtLastName" placeholder="Điền vào tên User" value="{!! old('txtLastName') !!}"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type='email' class="form-control" name="txtEmail" placeholder="Nhập vào Email"  value="{{ old('txtEmail') }}"/>
                            </div> 
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type='password' class="form-control" name="txtPass" placeholder="Nhập vào Mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Mật khẩu</label>
                                <input type='password' class="form-control" name="txtConfirmPass" placeholder="Nhập vào Email" />
                            </div>
                             <div class="form-group">
                                <label style="margin-right: 20px">Quyền hạn</label>
                                <label class="radio-inline">
                                    <input name="rdoQuyen" value="0" type="radio" checked="">Người dùng
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoQuyen" value="2"  type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
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