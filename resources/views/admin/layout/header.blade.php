
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">hox</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    @if(Auth::guard('admins')->user()->level == 2)
                        <?php $user = Auth::guard('admins')->user();
                        ?>
                    <a class="dropdown-toggle dropdown-noti_icon" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i><span class='noti_badge @if(count($user->unreadNotifications) > 0)noti_exists @endif'>@if (count($user->unreadNotifications) > 0) {{ count($user->unreadNotifications) }}@else 0 @endif</span>
                    </a>
                            @if(count($user->notifications) > 0 )
                                <ul class="dropdown-menu dropdown-user dropdown-medium">
                                <li class="mr-bot-10">
                                    <button class="btn btn-small btn-all-read btn-right">Đánh dấu tất cả đã đọc</button> 
                                    <div class="clear-float"></div>
                                </li>
                                @foreach($user->notifications as $key => $notification)
                                    <?php $data_noti = $notification->data;
                                        $data_bill_Detail = $data_noti['billDetail'];
                                        $date = $data_noti['billCreatedTime'];
                                        $date = \Carbon\Carbon::parse($date['date']);
                                        $after_format = $date->format('d-m-Y H:i:s');

                                        $hightLigth = "color: #007f7f";
                                        if($notification->read_at != null){
                                            $hightLigth = "color: #7f7f7f";
                                        }
                                    ?>
                                    <li><a href="{{route('admin.detail.bill',$data_bill_Detail['id'])}}" style="{{$hightLigth}}">Đơn đặt hàng mới nhất vào lúc: {{$after_format}}</a></li>
                                    <?php $notification->markAsRead(); ?>
                                @endforeach
                                </ul>
                            @else 
                                <ul class="dropdown-menu dropdown-user dropdown-medium">
                                    <p class='text-center text-warning mr-top-10'>Chưa có thông báo nào</p>
                                </ul>    
                            @endif  
                        @endif
                    <!-- /.dropdown-user -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">

                        <li><a href="javascript:void(0)"><i class="fa fa-user fa-fw"></i> 
                            @if(Auth::guard('admins')->check())
                            {{Auth::guard('admins')->user()->first_name}}
                            {{Auth::guard('admins')->user()->last_name}}
                        </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                         @endif
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{ route('admin-index')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-bar-chart-o fa-fw"></i> Danh mục<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('listdanhmuc') }}">Danh sách</a>
                                </li>
                                <li>
                                    <a href="{{ route('themdanhmuc') }}">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-cube fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/san-pham/danh-sach">Danh sách</a>
                                </li>
                                <li>
                                    <a href="admin/san-pham/them">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-bar-chart-o fa-fw"></i> Đơn hàng<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/don-hang/danh-sach">Danh sách</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-bar-chart-o fa-fw"></i> Thống kê <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/thong-ke/doanh-thu">Doanh thu</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-cube fa-fw"></i> Thương hiệu<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/thuong-hieu/danh-sach">Danh sách</a>
                                </li>
                                <li>
                                    <a href="admin/thuong-hieu/them">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/user/danh-sach">Danh sách</a>
                                </li>
                                <li>
                                    <a href="admin/user/them">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-cube fa-fw"></i> Kích thước<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/size/danh-sach">Danh sách</a>
                                </li>
                                <li>
                                    <a href="admin/size/them">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-cube fa-fw"></i> Coupon<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/coupon/danh-sach">Danh sách</a>
                                </li>
                                <li>
                                    <a href="admin/coupon/them">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>