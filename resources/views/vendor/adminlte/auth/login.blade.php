@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Log in
@endsection
<style>
    body {
        background-image: url("/img/background.jpg")  !important;
    }
</style>
@section('content')
<body class="hold-transition login-page">
    <div id="app">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/') }}">Hệ thống CA</a>
            </div><!-- /.login-logo -->

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (!empty(session('error')))
            <div class="alert alert-danger">
                <ul>
                    <li> {{ session('error') }}</li>
                </ul>
            </div>
        @endif

        <div class="login-box-body">
        <p class="login-box-msg"> Đăng nhập để bắt đầu phiên làm việc! </p>
        <form action="{{ route('login-web') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" required/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password" required/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div><!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/password/reset') }}"> Quên mật khẩu </a><br>
        <a href="{{ url('/register') }}" class="text-center"> Đăng kí tài khoản mới </a>

    </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
