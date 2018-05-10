<nav class="nav__sidebar user_profile_nav">
    <ul>
        <li @if(url()->current() == route('user_profile')) class='active' @endif>
            <a href="{{ route('user_profile') }}">Thông tin cá nhân</a>
        </li>
        <li @if(url()->current() == route('get.password')) class='active' @endif>
            <a href="{{ route('get.password')}}">Đổi mật khẩu</a>
        </li>
        <li>
            <a href="list_bill.html">Danh sách đơn hàng</a>
        </li>
    </ul>
</nav>