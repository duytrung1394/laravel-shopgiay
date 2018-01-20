@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thương hiệu
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên thương hiệu</th>
                                <th>Giới thiệu</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1;?>
                            @foreach($brands as $brand)
                            <tr class="odd gradeX" align="center">
                                <td>{{$stt}}</td>
                                <td>{{$brand->name}}</td>
                               
                                <td>
                                    {!!$brand->description!!}
                                </td>
            
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/thuong-hieu/xoa/{{$brand->id}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/thuong-hieu/sua/{{$brand->id}}">Edit</a></td>
                            </tr>
                            <?php $stt++;?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection