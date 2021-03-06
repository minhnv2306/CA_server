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
            <li class="user">
                <a href="{{route('users.index')}}">
                    <i class="fa fa-address-book"></i>
                    <span>Quản lý người dùng</span>
                </a>
            </li>
            @endcan
            <li class="profile">
                <a href="{{route('users.profile')}}"><i class="fa fa-user"></i>
                    <span>Hồ sơ cá nhân</span></a>
            </li>
            <li class="cert treeview ">
                <a href="#">
                    <i class="fa fa-id-card-o"></i> <span>Quản lý chứng thư</span>
                    <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="all-cert"><a href="{{route('certs.index')}}"><i class="fa fa-circle-o"></i>Tất cả chứng thư số</a></li>
                    <li class="my-cert"><a href="{{route('certs.my-cert')}}"><i class="fa fa-circle-o"></i>Chứng thư số tôi phát hành</a></li>
                </ul>
            </li>
            <li class="ca">
                <a href="{{route('ca')}}"><i class="fa fa-cog"></i>
                    <span>Nhà phát hành</span></a>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>