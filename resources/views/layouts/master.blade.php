<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
@include('components.admin.header')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('components.admin.nav')
    @include('components.admin.sidenav')

    @yield('content')
    @include('components.admin.footer')
</div>

@section('scripts')
    @include('components.admin.script')
@show
</body>
</html>
