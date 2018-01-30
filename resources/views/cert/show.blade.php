@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Thông tin chứng thư số {{$cert->id}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="http://wipro-crm.local/news/news_category"> Order</a></li>
                <li class="active">Create new order</li>
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
                                        <td class="padding-left-0"><strong>{{$cert->content}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Phone</td>
                                        <td class="padding-left-0"><strong>01658238399</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Address</td>
                                        <td class="padding-left-0"><strong>235 Nguyễn Ngọc Nại</strong></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="box-info col-md-12" style="margin-top: 30px;">

                                <div class="row" id="process-bar">
                                    <div class="col-sm-offset-5 col-md-4 status">
                                        <div class="circle background-color-active"><i class="fa fa-refresh fa-spin pending"></i></div>
                                        <div class="progress">Còn giá trị</div>
                                    </div>
                                </div>
                            </div>


                            <div class="row font-size-17">
                                <div class="col-md-12">
                                    <!-- general form elements -->
                                    <h3 class="box-title">Change status</h3>
                                    <!-- /.box-header -->
                                    <!-- form start -->

                                    <form method="POST" action="http://wipro-crm.local/order/orders/202" accept-charset="UTF-8"><input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="yVck25i82fPLzQWroviAkorMRcP5EOxS9JLsFLwT">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label for="sel1">Payment status</label>
                                                    @if($cert->status)
                                                        <select class="form-control" name="payment_status">
                                                            <option value="1">Còn hạn sử dụng</option>
                                                            <option value="0">Thu hồi</option>
                                                        </select>
                                                    @else
                                                        <select class="form-control" name="payment_status">
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
                                                        <textarea class="form-control" rows="5" name="note"></textarea>
                                                        <br/>
                                                        <button class="btn btn-primary">Submit note</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /.box-body -->
                                    <!-- /.box -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box tab-pane"  style="" id="comment-hisoty">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <center><h3>Comment history</h3></center>
                            </tr>
                            <tr>
                                <th>Comment at</th>
                                <th>Admin&#039;s comment</th>
                                <th>Content</th>
                            </tr>
                            </thead>
                            <tbody>
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
    <script src="{{asset('/js/category.js')}}"></script>
    <script src="{{asset('/js/order/add_product.js')}}"></script>
    <script src="{{asset('/js/order/delete_product.js')}}"></script>
    <script src="{{asset('/js/order/total_money.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection