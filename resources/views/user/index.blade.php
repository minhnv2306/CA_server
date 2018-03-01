@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Quản lý chứng thư
            </h1>
            <ol class="breadcrumb">
                <li><a href="http://cert.local/admin"><i class="fa fa-dashboard"></i> Trang chủ</a>
                </li>
                <li class="active">Quản lý chứng thư</li>
            </ol>
        </section>
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <div class="box box-info">
                        <div class="box-header">
                            <div class="row">

                                <div class="pull-right padding-right-15">
                                    <a class="btn btn-primary" id="addNew"
                                       href="{{route('certs.create')}}">
                                        <i class="fa fa-plus"></i> Tạo người dùng mới
                                    </a>
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
                                                <button href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#user{{$user->id}}"> <i class="fa fa-pencil"></i> Chỉnh sửa
                                                </button>
                                                <a href="#" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Xóa
                                                </a>
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
@endsection