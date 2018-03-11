<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/avatar.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{\Illuminate\Support\Facades\Auth::user()->name}} </p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

            <li class="">
                <a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a>
            </li>
            @can('manager-user')
            <li class="user-manager treeview">
                <a href="#">
                    <i class="fa fa-user-o"></i> <span>Quản lý người dùng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="user"><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i>Quản lý người dùng</a></li>
                    <li class="role"><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i>Thông tin cá nhân</a></li>
                </ul>
            </li>
            @endcan
            <li class="cert treeview ">
                <a href="#">
                    <i class="fa fa-id-card-o"></i> <span>Quản lý chứng thư</span>
                    <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="cert"><a href="{{route('certs.index')}}"><i class="fa fa-circle-o"></i>Chứng thư số cá nhân</a></li>
                </ul>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Cài đặt</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="http://cert.local/notification/notifications"><i class="fa fa-circle-o"></i>Thuật toán</a></li>
                    <li class=""><a href="http://cert.local/notification/notifications"><i class="fa fa-circle-o"></i>Thời hạn thuật toán</a></li>
                    <li class=""><a href="http://cert.local/notification/notifications"><i class="fa fa-circle-o"></i>Thông tin nhà phát hành</a></li>
                </ul>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>