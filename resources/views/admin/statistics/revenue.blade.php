@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thống Kê
                            <small>Doanh Thu</small>
                        </h1>
                    </div>
                    <div class="col-lg-12">
                        <div class='row type-report'>
                            <label>Loại báo cáo:</label>
                            <select id='type_report'>
                                <option value='none'>--Chọn--</option>
                                <option value='day'>Theo ngày</option>
                                <option value='month'>Theo tháng</option>
                                <option value='year'>Theo năm</option>
                            </select>

                            <label>Từ:</label>
                            <input type='date' id='from-date'></input>
                            
                            <label>Đến:</label>
                            <input type='date' id='to-date'></input>
                        
                            <span class='btn btn-primary' id='report-button'>Báo cáo</span>
                        </div>
                        <div style="clear:both"></div>
                    </div> <!-- /.col-lg-12 -->
                </div>
                <!--end-row-->
                <div  class='row' id='list-result'>
                    <div>
                        <h4 id='title-filter'>20 ngày gần đây nhất</h4>
                    </div>
                    <div style='width:100%; height:500px; overflow-y:auto;'>
                    <table class="table table-striped table-bordered table-hover list-result" >
                        
                        <thead>
                            <tr align="center">
                                <th>Stt</th>
                                <th>Thời gian</th>
                                <th>Tổng tiền</th>
                                <th>Tống số đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody id='result-data'>
                            @if(count($doanhthu) > 0)
                                <?php $stt = 1;?>
                                @foreach($doanhthu as $row)
                                    <tr>
                                        <td>{{ $stt }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>{{ number_format($row->total_price) }}</td>
                                        <td>{{ $row->total_bill }}</td>
                                    </tr>
                                    <?php $stt++ ;?>
                                @endforeach
                            @else
                                <tr>
                                    <td></td>
                                    <td>Không thể thống kê</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    </div>
                    <!--end-div-table-->
                </div>
                <!--end-list-result-->
            </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#report-button').click(function(){
                var from_date = $('#from-date').val();
                var to_date = $('#to-date').val();
                var type = $('#type_report').val();
                var flag = true;
                if(type === "none"){
                    alert('Bạn chưa chọn loại báo cáo');
                    flag = false;
                }
                if(from_date === ""){
                    alert('Bạn chưa nhập thời gian bắt đầu');
                    flag = false;
                }
                if(to_date === ""){
                    alert('Bạn chưa nhập thời gian cuối báo cáo');
                    flag = false;
                }
                if(from_date > to_date){
                    alert('Thời gian bắt đầu phải trước thời gian đến');
                    flag = false;
                }
                if(flag === true){
                    var data = {
                        type : type,
                        from_date : from_date,
                        to_date : to_date
                    }
                    
                    $.ajax({
                        url : "admin/ajax/report-date",
                        type : "post",
                        data : data,
                        async: true,
                        success: function(result){
                            $('#list-result').html(result);
                        }
                    });
                }
            })
        })
    </script>
@endsection