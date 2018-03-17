@extends('layouts.master')
@section('title', 'Hồ sơ cá nhân')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Hồ sơ cá nhân #{{$user->id}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="{{route('users.index')}}"> Quản lý người dùng</a></li>
                <li class="active">Thông tin cá nhân</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content row">

            <div class="col-sm-3">
                <div class="box box-solid">
                    <div class="box-header with-border">

                        <img src="/img/avatar04.png" width="100%">
                    </div>
                    <!-- /.box-body -->
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="box-info col-md-12" style="margin-top: 30px;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 tab-content">
                <div class="box box-info tab-pane active" id="infomation">
                    <div class="box-header with-border padding-left-25">
                        <div class="row">
                            <div class="box-info col-sm-12">
                                <h3>Thông tin cá nhân</h3>
                                <table class="table-striped" width="100%">
                                    <tr>
                                        <td class="width-200">Họ và tên</td>
                                        <td class="padding-left-0"><strong>{{$user->name}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Email</td>
                                        <td class="padding-left-0"><strong>{{$user->email}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Số điện thoại</td>
                                        <td class="padding-left-0"><strong>{{$user->phone_number}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Địa chỉ làm việc</td>
                                        <td class="padding-left-0"><strong>{{$user->work}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 pull-right">
                                <div class="form-group">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#profile">Chỉnh sửa</button>
                                    @include('components.modal.user_profile')
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#change-password">Đổi mật khẩu</button>
                                    @include('components.modal.change_password')
                                </div>
                            </div>
                        </div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
        </section>
    </div>


@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('.user-manager').addClass('active');
            $('.profile').addClass('active');
        });
    </script>
    @include('components.admin.toastr')
@endsection