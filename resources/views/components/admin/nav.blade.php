<header class="main-header">
    <!-- Logo -->
    <a href="http://cert.local/admin" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>W</b>U</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="/img/avatar.png" class="user-image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="/img/avatar.png" class="img-circle"
                                 alt="User Image">

                            <p>
                                {{\Illuminate\Support\Facades\Auth::user()->email}}
                                <small>Thành viên từ {{\Illuminate\Support\Facades\Auth::user()->created_at}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Change user infomation</a>
                            </div>
                            <div class="pull-right">
                                <form method="POST" action="/logout">
                                    {!!  csrf_field()!!}
                                    <button class="btn btn-default btn-flat">Log out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>