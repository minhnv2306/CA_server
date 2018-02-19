@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Tạo chứng thư số
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="{{route('certs.index')}}"> Chứng thư số</a></li>
                <li class="active">Tạo</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="container">
                    <div class="row font-size-17">
                        <div class="col-sm-12">
                            <form id="form_cat_add" class="form-add-news-category" method="post" action="{{route('certs.store')}}">
                                <div class="box-body">
                                    <fieldset class="col-sm-12">
                                        <legend>Thông tin khách hàng</legend>
                                        <div id="choose_product">

                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label for="email">Họ và tên(*): </label>
                                                    <input class="form-control" name="name" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label for="email">Email:</label>
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="email">Số điện thoại:</label>
                                                    <input type="number" class="form-control" name="phone_number">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label for="email">Số chứng minh thư(*):</label>
                                                    <input type="text" class="form-control" name="identification_card" required>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label for="email">Ngày cấp(*):</label>
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input type='text' class="form-control" name="date_create_id_cart" required/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label for="email">Nơi cấp(*):</label>
                                                    <input type="text" class="form-control" id="where_create_id_cart" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label for="email">Địa chỉ làm việc:</label>
                                                    <input type="text" class="form-control" name="organizationname">
                                                </div>
                                            </div>
                                            <div class="row product">
                                                <div class="col-sm-12">
                                                    <label for="email">Quê quán:</label>
                                                    <table class="table table-responsive table-bordered">
                                                        <thead>
                                                        <th>Tỉnh</th>
                                                        <th>Quận (Huyện)</th>
                                                        <th>Xã (Phường/ Thị trấn)</th>
                                                        </thead>
                                                        <tbody id="body_files">
                                                        <tr class="tr_clone">
                                                            <td>
                                                                <div class="form-group">
                                                                    <select class="js-example-basic-single"
                                                                            id="cate_product" style="width: 100%" name="tinh">
                                                                        <option value="Hà Nội">Hà Nội</option>
                                                                    </select>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group" id="display_products">
                                                                    <div class="form-group">
                                                                        <select class="js-example-basic-single"
                                                                                name="district" id="products1"
                                                                                style="width: 100%">
                                                                            <option value="Hoàng Văn Thụ">Hoàng Mai</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group" id="display_products">
                                                                    <div class="form-group">
                                                                        <select class="js-example-basic-single"
                                                                                name="ward" id="products1"
                                                                                style="width: 100%">
                                                                            <option value="Hoàng Mai">Hoàng Mai</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        <tfoot>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </fieldset>

                                    <fieldset class="col-sm-12">
                                        <legend>Thông tin chứng thư</legend>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sel1">Thời hạn</label>
                                                    <select class="form-control" name="deadline">
                                                        <option value=1> 1 năm
                                                        </option>
                                                        <option value=2> 2 năm
                                                        </option>
                                                        <option value=3> 3 năm
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="sel1">Ghi chú</label>
                                                    <textarea class="form-control" rows="5" name="note"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        <div class="col-md-6 text-left"><a href="http://wipro-crm.local/order/orders"
                                                                           class="btn btn-default">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format:'YYYY-MM-DD HH:mm:ss',
                });
            });
        });
    </script>
@endsection