@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Thông tin chứng thư số #{{$cert->id}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="http://wipro-crm.local/news/news_category"> Chứng thư số</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content row">

            <div class="row">
            </div>

            <div class="col-sm-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Tổng quan</h4>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-tabs tabs-left">
                            <li class="active"><a href="#infomation" data-toggle="tab">Information</a></li>
                            <li><a href="#comment-hisoty" data-toggle="tab">Comment history</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-sm-9 tab-content">
                <div class="box box-info tab-pane active" id="infomation">
                    <div class="box-header with-border padding-left-25">
                        <div class="row">
                            <div class="box-info col-sm-12">
                                <h3>Thông tin khách hàng</h3>
                                <table class="table-striped" width="100%">
                                    <tr>
                                        <td class="width-200">Họ và tên</td>
                                        <td class="padding-left-0"><strong>{{$cert->customer_name}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Email</td>
                                        <td class="padding-left-0"><strong>{{$cert->email}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Số điện thoại</td>
                                        <td class="padding-left-0"><strong>{{$cert->phone_number}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Số chứng minh thư</td>
                                        <td class="padding-left-0"><strong>{{$cert->identification_card}}</strong></td>
                                    </tr>
                                    <tr class="border-hidden">
                                        <td class="width-200">Ngày cấp</td>
                                        <td class="padding-left-0"><strong>{{$cert->date_create_id_cart}} </strong></td>
                                    </tr>

                                    <tr class="border-hidden">
                                        <td class="width-200">Địa chỉ</td>
                                        <td class="padding-left-0"><strong>{{$cert->address}}</strong></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info col-sm-12">
                                <h3>Thông tin chứng thư</h3>
                                <table class="table-striped" width="100%">
                                    <tr>
                                        <td class="width-200">Nội dung</td>
                                        <td class="padding-left-0">
                                            <strong>{{$key}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Thuật toán</td>
                                        <td class="padding-left-0">
                                            <strong>{{$certInfor['signatureAlgorithm']['algorithm']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Ngày bắt đầu</td>
                                        <td class="padding-left-0">
                                            <strong>{{$certInfor['tbsCertificate']['validity']['notBefore']['utcTime']}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Ngày kết thúc</td>
                                        <td class="padding-left-0">
                                            <strong>{{$certInfor['tbsCertificate']['validity']['notAfter']['utcTime']}}</strong>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info col-sm-12">
                                <h3>Thông tin người cấp</h3>
                                <table class="table-striped" width="100%">
                                    <tr>
                                        <td class="width-200">Họ và tên</td>
                                        <td class="padding-left-0">
                                            <strong>{{$cert->user->name}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Email</td>
                                        <td class="padding-left-0">
                                            <strong>{{$cert->user->email}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Số điện thoại</td>
                                        <td class="padding-left-0">
                                            <strong>{{$cert->user->phone_number}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Ngày tạo</td>
                                        <td class="padding-left-0">
                                            <strong>{{$cert->created_at}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Quyền</td>
                                        <td>
                                            @if($cert->user->role_id == 2)
                                                <span class="label label-success">User</span>
                                            @else
                                                <span class="label label-danger">Admin</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Địa điểm</td>
                                        <td class="padding-left-0">
                                            <strong>{{$cert->user->work}}</strong>
                                        </td>
                                    </tr>

                                </table>
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
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="box-info col-md-12" style="margin-top: 30px;">
                                @if($cert->status == 1)
                                    <div class="row" id="process-bar">
                                        <div class="col-sm-offset-5 col-md-4 status">
                                            <div class="circle background-color-active"><i
                                                        class="fa fa-refresh fa-spin pending"></i></div>
                                            <div class="progress">Còn giá trị</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row" id="process-bar">
                                        <div class="col-md-4 col-md-offset-5 status">
                                            <div class="circle background-red"><i class="fa fa-times"
                                                                                  style="font-size: 80px"></i></div>
                                            <div class="progress">Thu hồi</div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @can('edit', $cert)
                                <div class="row font-size-17">
                                    <div class="col-md-12">
                                        <!-- general form elements -->
                                        <h3 class="box-title">Change status</h3>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        {!! Form::open([
                                            'route' => ['certs.update', 'user' => $user->id],
                                            'method' => 'PUT',
                                        ]) !!}
                                            <input type="hidden" name="id" value="{{$cert->id}}">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label for="sel1">Payment status</label>
                                                        @if($cert->status)
                                                            <select class="form-control" name="status">
                                                                <option value="1">Còn hạn sử dụng</option>
                                                                <option value="0">Thu hồi</option>
                                                            </select>
                                                        @else
                                                            <select class="form-control" name="status">
                                                                <option value="0">Thu hồi</option>
                                                                <option value="1">Còn hạn sử dụng</option>
                                                            </select>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="comment">Note</label>
                                                            <textarea class="form-control" rows="5"
                                                                      name="note"></textarea>
                                                            <br/>
                                                            <button class="btn btn-primary">Cập nhật</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {!! Form::close() !!}
                                        <!-- /.box-body -->
                                        <!-- /.box -->
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="box tab-pane" style="" id="comment-hisoty">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <center><h3>Lịch sử thay đổi</h3></center>
                            </tr>
                            <tr>
                                <th>Thời gian</th>
                                <th>Người thay đổi</th>
                                <th>Nội dung</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->created_at}}</td>
                                    <td>{{$comment->user->name}}</td>
                                    <td>{{$comment->content}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
            $('.js-example-basic-single').select2();
            $('.cert').addClass('active');
        });
    </script>
    @include('components.admin.toastr')
@endsection