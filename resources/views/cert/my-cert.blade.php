@extends('layouts.master')
@section('title', 'Quản lý chứng thư')
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
                                <div class="col-sm-6 pull-left" id="status_title">
                                    Lọc chứng thư theo trạng thái
                                </div>

                                <div class="pull-right padding-right-15">
                                    <a class="btn btn-primary" id="addNew"
                                       href="{{route('certs.create')}}">
                                        <i class="fa fa-plus"></i> Tạo chứng thư mới
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
                                        <button data-status="1" class="btn btn-success filterStatus">Còn giá trị
                                        </button>
                                        <button data-status="2" class="btn btn-default filterStatus">Xem tất cả</button>
                                    </div>

                                    <div class="pull-right padding-right-15">
                                        <!-- filter theo ngay -->
                                        {!! Form::open([
                                            'route' => 'filterCert',
                                            'method' => 'POST'
                                        ]) !!}
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
                                <table id="list-cert"
                                       class="table no-margin data_table table table-bordered table-striped ">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Họ và tên</th>
                                        <th>Số chứng minh thư</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
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
                                                    <span class="label label-success">Còn hạn</span>
                                                @else
                                                    <span class="label label-danger">Hết hạn</span>
                                                @endif
                                            </td>
                                            <td>{{$cert->created_at}}</td>
                                            <td>
                                                <a href="{{route('certs.show', ['cert' => $cert->id])}}"
                                                   class="btn btn-primary btn-xs"> <i class="fa fa-pencil"></i> Xem chi
                                                    tiết
                                                </a>
                                                @if ($cert->status == 1 && \Illuminate\Support\Facades\Auth::user()->can('edit', $cert))
                                                    {!! Form::open([
                                                        'route' => ['certs.destroy', 'cert' => $cert->id],
                                                        'method' => 'delete',
                                                        'class' => 'inline'
                                                    ]) !!}
                                                    <button class="btn btn-danger btn-xs evict"><i
                                                                class="fa fa-trash"></i> Thu hồi
                                                    </button>
                                                    {!! Form::close() !!}
                                                @endif
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
        $(document).ready(function () {
            var statusBtn = [
                '<span class="label label-danger">Hết hạn</span>',
                '<span class="label label-success">Còn hạn</span>',
            ];
            $('.filterStatus').click(function () {
                var status = $(this).attr('data-status');
                $.ajax({
                    url: 'certs/filter-status/' + status,
                    type: 'GET',
                    beforeSend: function () {
                        $('#list-cert').waitMe({
                            effect: 'bounce',
                            text: '',
                            bg: 'rgba(255,255,255,0.7)',
                            color: '#000'
                        });
                    },
                    success: function (result, status) {
                        $('#list-cert').waitMe('hide');
                        var datatable = $('#list-cert').DataTable();
                        datatable.clear().draw();
                        var dataTable = []

                        result.forEach(function (data) {
                            index = (data.status ? 1 : 0);
                            console.log(index);
                            data.status = statusBtn[index];
                            if (index == 1) {
                                data.action = '<a href="/certs/' + data.id + '" id="edit" class="btn btn-primary btn-xs">'
                                    + ' <i class="fa fa-pencil"> Xem chi tiết </i> </a> ';
                            } else {
                                data.action = '<a href="/certs/' + data.id + '" id="edit" class="btn btn-primary btn-xs">'
                                    + ' <i class="fa fa-pencil"> Xem chi tiết </i> </a> ';
                            }
                            dataTable.push(Object.values(data));
                        });
                        datatable.rows.add(dataTable); // Add data to datatable, array
                        datatable.columns.adjust().draw(); // Redraw the DataTable
                        datatable.order([0, 'desc']).draw();
                    }
                })
            })

            $('.evict').click(function (e) {
                var r = confirm("Bạn có thực sự muốn thu hồi chứng thư này!");
                if (r == true) {
                    txt = "You pressed OK!";
                } else {
                    e.preventDefault();
                }
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $('.cert').addClass('active');
            $('.my-cert').addClass('active');
        });
    </script>

    @include('components.admin.toastr')
@endsection