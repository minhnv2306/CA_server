@extends('layouts.master')
@section('title', 'Quản lý phân quyền')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý quyền
            </h1>
            <ol class="breadcrumb">
                <li><a href="http://cert.local/admin"><i class="fa fa-dashboard"></i> Trang chủ</a>
                </li>
                <li class="active">Quản lý quyền</li>
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
                                        <i class="fa fa-plus"></i> Tạo quyền
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
                                        <th>Tên quyền</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td> {{$role->id}}</td>
                                            <td> {{$role->name}}</td>
                                            <td>
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#role{{$role->id}}"> <i class="fa fa-pencil"></i> Chỉnh sửa
                                                </button>
                                                {!! Form::open([
                                                    'route' => ['roles.destroy', 'role' => $role->id],
                                                    'method' => 'DELETE',
                                                    'class' => 'inline'
                                                ]) !!}
                                                <button class="btn btn-danger btn-xs delete-role"> <i class="fa fa-trash"></i> Xóa
                                                </button>
                                                {!! Form::close() !!}
                                                @include('components.modal.role_show', ['role' => $role])
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
        $('.delete-role').click(function (e) {
            if(!confirm('Bạn có thực sự muốn xóa?')) {
                e.preventDefault();
            }
        })
        $('.user-manager').addClass('active');
        $('.role').addClass('active');
    </script>
@endsection