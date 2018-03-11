@extends('layouts.master')
@section('title', 'Quản lý người dùng')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý người dùng
            </h1>
            <ol class="breadcrumb">
                <li><a href="http://cert.local/admin"><i class="fa fa-dashboard"></i> Trang chủ</a>
                </li>
                <li class="active">Quản lý người dùng</li>
            </ol>
        </section>
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <div class="box box-info">
                        <div class="box-header">
                            <div class="row">
                                <div class="pull-right padding-right-15">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#create-user"
                                            id="addNew">
                                        <i class="fa fa-plus"></i> Tạo người dùng mới
                                    </button>

                                    @include('components.modal.user_create')
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">

                                <table id="list-cert"
                                       class="table no-margin data_table table table-bordered table-striped ">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Họ và tên</th>
                                        <th>Quyền</th>
                                        <th>Chi nhánh</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td> {{$user->id}}</td>
                                            <td> {{$user->email}}</td>
                                            <td> {{$user->name}}</td>
                                            <td>
                                                @if($user->role_id == 2)
                                                    <span class="label label-success">User</span>
                                                @else
                                                    <span class="label label-danger">Admin</span>
                                                @endif
                                            </td>
                                            <td> {{$user->work}}</td>
                                            <td> {{$user->phone_number}}</td>
                                            <td> {{$user->created_at}}</td>
                                            <td>
                                                @can('edit', $user)
                                                    <button class="btn btn-primary btn-xs" data-toggle="modal"
                                                            data-target="#user{{$user->id}}"><i
                                                                class="fa fa-pencil"></i> Chỉnh sửa
                                                    </button>
                                                    @include('components.modal.user_show', ['user' => $user])
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id != $user->id)
                                                        {!! Form::open([
                                                            'route' => ['users.destroy', 'user' => $user->id],
                                                            'method' => 'DELETE',
                                                            'class' => 'inline'
                                                        ]) !!}
                                                        <button class="btn btn-danger btn-xs delete-user"><i
                                                                    class="fa fa-trash"></i> Xóa
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @endif
                                                @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="loading"></div>
                            </div><!--table-responsive-->

                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>

    </div>
@endsection
@section('scripts')
    @parent
    @include('components.admin.toastr')
    <script>
        $('.delete-user').click(function (e) {
            if (!confirm('Bạn có thực sự muốn xóa?')) {
                e.preventDefault();
            }
        })
        $('.user-manager').addClass('active');
        $('.user').addClass('active');
        $('#create-user-button').click(function (e) {
            var data = {
                email: $('#email').val(),
                name: $('#name').val(),
                role_id: $('#role_id').val(),
                password: $('#password').val(),
                password_confirmation: $('#password_confirmation').val()
            }
            if (data.email && data.name && data.password && data.password_confirmation) {
                e.preventDefault();
                $.ajax({
                    url: '/users/checkCreate',
                    type: 'POST',
                    data: data,
                    beforeSend: function () {
                        $('.modal-body').waitMe({
                            effect: 'bounce',
                            text: 'Đang xử lý',
                            bg: 'rgba(255,255,255,0.7)',
                            color: '#000'
                        });
                    },
                    success: function (data) {
                        $('.modal-body').waitMe('hide');
                        if (data.result == 0) {
                            alert(data.message);
                        } else {
                            $('#create-user-form').submit();
                        }
                    }
                });
            }
        })
    </script>
@endsection