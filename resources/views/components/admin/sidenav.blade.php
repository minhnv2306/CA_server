<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://www.w3schools.com/bootstrap/img_avatar3.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin </p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

            <li class="">
                <a href="http://cert.local/admin/dashboard"><i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="  treeview ">
                <a href="#">
                    <i class="fa fa-user-o"></i> <span>User Manager</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="http://cert.local/notification/notifications">User</a></li>
                </ul>
            </li>

            <li class="active treeview ">
                <a href="#">
                    <i class="fa fa-id-card-o"></i> <span>Cert manager</span>
                    <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('certs.index')}}">Cert</a></li>
                </ul>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>