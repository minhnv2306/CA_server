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
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#create-user" id="addNew">
                                        <i class="fa fa-plus"></i> Tạo người dùng mới
                                    </button>

                                    @include('components.modal.user_create')
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">

                                <table id="list-cert" class="table no-margin data_table table table-bordered table-striped ">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Họ va tên</th>
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
                                            <td> {{$user->created_at}}</td>
                                            <td>
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#user{{$user->id}}"> <i class="fa fa-pencil"></i> Chỉnh sửa
                                                </button>
                                                {!! Form::open([
                                                    'route' => ['users.destroy', 'user' => $user->id],
                                                    'method' => 'DELETE',
                                                    'class' => 'inline'
                                                ]) !!}
                                                <button class="btn btn-danger btn-xs delete-user"> <i class="fa fa-trash"></i> Xóa
                                                </button>
                                                {!! Form::close() !!}
                                                @include('components.modal.user_show', ['user' => $user])
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
            if(!confirm('Bạn có thực sự muốn xóa?')) {
                e.preventDefault();
            }
        })
    </script>
@endsection