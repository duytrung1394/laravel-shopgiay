@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh mục
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Tên đầy đủ</th>
                                <th>Danh mục cha</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1;?>
                            @foreach($cates as $cate)
                            <tr class="odd gradeX" align="center">
                                <td>{{$stt}}</td>
                                <td>{{$cate->name}}</td>
                                <td>{{$cate->full_name}}</td>
                                <td>
                                    @if($cate->parent_id == 0)
                                    {{ "Gốc" }}
                                    @else 
                                    <?php 
                                        $item = DB::table('category')->where("id",$cate->parent_id)->first();
                                        echo $item->name;
                                    ?>
                                    @endif
                                </td>
                               
                                <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="admin/danh-muc/xoa/{{$cate->id}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/danh-muc/sua/{{$cate->id}}">Edit</a></td>
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
