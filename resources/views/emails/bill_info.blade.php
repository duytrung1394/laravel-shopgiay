@component('mail::message')
# ShopGiay

Xin chào {{$customer->last_name}},<br/>
Cảm ơn đã sử dụng dịch vụ của chúng tôi. 
Bạn đã mua sản phẩm của chúng tôi, thông tin chi tiết đơn hàng:
* Họ và tên: {{$customer->first_name}} {{$customer->last_name}}
* Giới tính: @if($customer->gender == 1) nam @else nữ @endif
* Địa chỉ: {{$customer->address}}
* Điện thoại liên hệ: {{$customer->phone}}
    </br>
    </br>
    <table>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Kích cỡ</th>
            <th>Đơn giá</th>
            <th>Giảm giá</th>
            <th>Thành tiền</th>
        </tr>
        
        <?php $stt = 1;?>
        @foreach($cart as $row)
            <tr>    
                <td> {{$stt}}</td>
                <td> {{$row->name}}</td>
                <td> {{$row->qty}} chiếc</td>
                <td><?php  $size = \App\Size::find($row->options->size_id);?>
                    {{$size->name}}
                </td>
                <td> {{number_format($row->price)}} vnđ</td>
                <td> @if($coupon == 0) không áp dụng @else {{$coupon * 100}}% @endif</td>
                <td> <?php $subtotal = ($row->qty * $row->price) - ($coupon * ($row->qty * $row->price)); ?>
                {{ number_format($subtotal) }} vnđ</td>
            </tr>
            <?php $stt++; ?>
        @endforeach
        
        <tr>
            <td colspan='5'>Tổng tiền:</td>
            <td colspan='2'>{{ number_format($total_price)}} vnđ</td>
        </tr>
    </table>
    

   
Thanks,<br>
 trung
@endcomponent
