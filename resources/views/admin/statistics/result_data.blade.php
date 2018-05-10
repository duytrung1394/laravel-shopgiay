
<div>
        <h4 id='title-filter'>{{$title}}</h4>
</div>
<div style='width:100%; height:500px; overflow-y:auto;'>
    <table class="table table-striped table-bordered table-hover list-result" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>Stt</th>
            <th>Thời gian</th>
            <th>Tổng tiền</th>
            <th>Tống số đơn hàng</th>
        </tr>
    </thead>
    <tbody id='result-data'>
        @if(count($data) > 0)
            <?php $stt = 1;?>
            @foreach($data as $row)
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ displayTime($row, $type) }}</td>
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
<?php 
    function displayTime($data, $type){
        switch($type){
            case 'day':
                return 'Ngày '.$data->day;
                break;
            case 'month':
                return 'Tháng '.$data->month." Năm ".$data->year;
                break;
            case 'year':
                return "Năm ". $data->year;
                break;
            default:
                return "Không xác định";
        }
}