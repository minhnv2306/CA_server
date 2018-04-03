@extends('layouts.master')
@section('title', 'Nhà phát hành')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Thông tin nhà phát hành
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li class="active">Thông tin cá nhân</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content row">

            <div class="col-sm-3">
                <div class="box box-solid">
                    <div class="box-header with-border">

                        <img src="/img/intro02.png" width="100%">
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
                                <h3>Thông tin nhà phát hành chứng thư</h3>
                                <table class="table-striped" width="100%">
                                    <tr>
                                        <td class="width-200">Đất nước</td>
                                        <td class="padding-left-0"><strong>Việt Nam</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Tổ chức quản lý</td>
                                        <td class="padding-left-0"><strong>HUST</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Tên nhà phát hành chứng thư</td>
                                        <td class="padding-left-0"><strong>Minh NV Cert</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="width-200">Thuật toán</td>
                                        <td class="padding-left-0"><strong>sha1WithRSAEncryption</strong></td>
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
            $('.ca').addClass('active');
        });
    </script>
    @include('components.admin.toastr')
@endsection