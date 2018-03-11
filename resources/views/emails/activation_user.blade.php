@component('mail::message')
# ShopGiay

Chào mừng {{$user->last_name}} đến với cửa hàng của chúng tôi. Vui lòng nhấn vào nút dưới đây để kích hoạt tài khoản

@component('mail::button', ['url' => $activation_link])
Kích hoạt
@endcomponent

Thanks,<br>
trung
@endcomponent
