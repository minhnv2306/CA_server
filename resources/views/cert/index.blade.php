@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Order manager
            </h1>
            <ol class="breadcrumb">
                <li><a href="http://cert.local/admin"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Order manager</li>
            </ol>
        </section>
        <section class="content">


            <div class="row">
                <div class="col-xs-12">

                    <div class="box box-info">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-sm-6 pull-left" id="status_title">
                                    Filter follow order&#039;s status
                                </div>

                                <div class="pull-right padding-right-15">
                                    <a class="btn btn-primary" id="addNew"
                                       href="{{route('certs.create')}}">
                                        <i class="fa fa-plus"></i> Create new order
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">

                                <div class="row dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="col-md-6 pull-left">
                                        <button data-status="0" class="btn btn-danger filterStatus">Hết hạn</button>
                                        <button data-status="3" class="btn btn-success filterStatus">Còn giá trị</button>
                                        <button data-status="5" class="btn btn-default filterStatus">Xem tất cả</button>
                                    </div>

                                    <div class="pull-right padding-right-15">
                                        <!-- filter theo ngay -->
                                        <form action="http://cert.local/order/filterRangeDate" method="post">
                                            <input type="hidden" name="_token"
                                                   value="mzK75lqSiC93Br6fb1KzCM3YpsY7m5g0Y9z5hdB6">
                                            <div class="input-group date">
                                                <input type="text" id="date-start" name="startDate" autocomplete="off"
                                                       class="form-control pull-left" required placeholder="From">
                                                <div id="start" class="input-group-addon btn btn-default">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <div class="input-group date">
                                                <input type="text" id="date-end" name="endDate" autocomplete="off"
                                                       class="form-control pull-left" required placeholder="To">
                                                <div id="end" class="input-group-addon btn btn-default">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-default"
                                                   value="Filter">
                                        </form>
                                    </div>
                                </div>
                                <table id="listOrder"
                                       class="table no-margin data_table table table-bordered table-striped ">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer email</th>
                                        <th>Customer name</th>
                                        <th>ID cart</th>
                                        <th>Payment status</th>
                                        <th>Create at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($certs as $cert)
                                    <tr>
                                        <td>{{$cert->id}}</td>
                                        <td>{{$cert->email}}</td>
                                        <td>{{$cert->customer_name}}</td>
                                        <td>{{$cert->identification_card}}</td>
                                        <td>
                                            @if($cert->status)
                                                <span class="label label-success">Con han</span>
                                            @else
                                                <span class="label label-danger">Cancel</span>
                                            @endif
                                        </td>
                                        <td>{{$cert->created_at}}</td>
                                        <td>
                                            <a href="{{route('certs.show', ['cert' => $cert->id])}}" class="btn btn-primary btn-xs"> <i class="fa fa-pencil"></i> Xem chi tiet
                                            </a>
                                            <a href="#" class="btn btn-warning btn-xs"> <i class="fa fa-pencil"></i> Cap phat lai
                                            </a>
                                            <a href="#" class="btn btn-danger btn-xs"> <i class="fa fa-pencil"></i> Thu hoi
                                            </a>
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
    <script>
        function myFunction() {
            var x = document.getElementById("cate_product").value;
            console.log(x);

            $.ajax({
                url: '/order/products',
                type: 'POST',
                data: {
                    cate_id: x,
                    _token: $('meta').attr('name', 'csrf-token').val()
                },
                beforeSend: function () {
                    $('#display_products').waitMe({
                        effect: 'bounce',
                        text: '',
                        bg: 'rgba(255,255,255,0.7)',
                        color: '#000'
                    });
                },
                success: function (data, status) {
                    $('#display_products').waitMe('hide');
                    $('#products1').html('');
                    $('#products1').append(data);
                }
            })
        }
    </script>
    <script src="{{asset('/js/category.js')}}"></script>
    <script src="{{asset('/js/order/add_product.js')}}"></script>
    <script src="{{asset('/js/order/delete_product.js')}}"></script>
    <script src="{{asset('/js/order/total_money.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
    </script>

    @if(session()->has('messages'))
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            toastr.success('Tạo chứng thư thành công');
        </script>
    @endif
    @if(session()->has('errors'))
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            toastr.error('Tạo chứng thư thất bại');
        </script>
    @endif
@endsection