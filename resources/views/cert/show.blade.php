@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Detail order 202
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
                        <h4 class="box-title">Over view</h4>

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
                            <div class="box-info col-sm-6">
                                <h3>Detail order</h3>
                                <table class="table-striped" width="100%">
                                    <tr>
                                        <td class="width-200">Detail order</td>
                                        <td class="padding-left-0"><strong>#202</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Create at</td>
                                        <td class="padding-left-0"><strong>2018-01-29 17:44:25</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Payment</td>
                                        <td class="padding-left-0"><strong>Unpay</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Order status</td>
                                        <td class="padding-left-0">
                                            <span class="label label-warning">Pending</span>
                                        </td>
                                    </tr>
                                    <tr class="border-hidden">
                                        <td class="width-200">Note</td>
                                        <td class="padding-left-0"><strong>No note in this order </strong></td>
                                    </tr>

                                    <tr class="border-hidden">
                                        <td class="width-200">Total money</td>
                                        <td class="padding-left-0"><strong>325,000 $</strong></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="box-info col-sm-6">
                                <h3>Customer information</h3>
                                <table class="table-striped" width="100%">
                                    <tr class="border-hidden">
                                        <td class="width-200">Customer name</td>
                                        <td class="padding-left-0"><strong>test001</strong></td>
                                    </tr>
                                    <tr class="border-hidden">
                                        <td class="width-200">Customer email</td>
                                        <td class="padding-left-0"><strong>test001@gmail.com </strong></td>
                                    </tr>
                                    <tr class="border-hidden">
                                        <td class="width-200">Phone number</td>
                                        <td class="padding-left-0"><strong>01679481315 </strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info col-sm-6">
                                <h3>Billing information</h3>
                                <table class="table-striped" width="100%">
                                    <tr>
                                        <td class="width-200">Name</td>
                                        <td class="padding-left-0"><strong>Lanhnt</strong></td>
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

                            <div class="box-info col-sm-6">
                                <h3>Shipping information</h3>
                                <table class="table-striped" width="100%">
                                    <tr>
                                        <td class="width-200">Name</td>
                                        <td class="padding-left-0"><strong></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Phone</td>
                                        <td class="padding-left-0"><strong></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Address</td>
                                        <td class="padding-left-0"><strong></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Date shipping</td>
                                        <td class="padding-left-0"><strong>0000-00-00 00:00:00</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Note</td>
                                        <td class="padding-left-0"><strong></strong></td>
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
                            <h3 class="box-title">Items ordered</h3>
                            <!-- /.box-header -->
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Name</th>
                                        <th>Unit price</th>
                                        <th>Number</th>
                                        <th>Total money</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>61</td>
                                        <td>BIO N/HOA HONG SUA ONG CHUA+ATP 100ML NO MIT</td>
                                        <td>325,000 $</td>
                                        <td>1</td>
                                        <td>325,000 $</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-info col-md-12" style="margin-top: 30px;">

                                <div class="row" id="process-bar">
                                    <div class="col-md-4 col-md-offset-1 status">
                                        <div class="circle background-color-active"><i class="fa fa-refresh fa-spin pending"></i></div>
                                        <div class="line"></div>
                                        <div class="progress">Pending</div>
                                    </div>
                                    <div class="col-md-4 status">
                                        <div class="circle background-white"></div>
                                        <div class="line"></div>
                                        <div class="progress">Shipping</div>
                                    </div>
                                    <div class="col-md-1 status">
                                        <div class="circle"></div>
                                        <div class="progress">Complete</div>
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
                                                    <select class="form-control" name="payment_status">
                                                        <option value="0">Unpay</option>
                                                        <option value="1">Pay</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-sm-6">
                                                    <label for="sel1">Order status</label>

                                                    <select class="form-control" name="order_status"><option value="0">Canceled</option><option value="1" selected="selected">Pending</option><option value="2">Shipping</option><option value="3">Complete</option></select>

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