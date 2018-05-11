<nav class="nav__sidebar user_profile_nav">
    <ul>
        <li @if(url()->current() == route('user.profile')) class='active' @endif>
            <a href="{{ route('user.profile') }}">Thông tin cá nhân</a>
        </li>
        <li @if(url()->current() == route('get.password')) class='active' @endif>
            <a href="{{ route('get.password')}}">Đổi mật khẩu</a>
        </li>
        <li @if(url()->current() == route('list.bill')) class='active' @endif>
            <a href="{{ route('list.bill') }}">Danh sách hóa đơn</a>
        </li>
    </ul>
</nav>