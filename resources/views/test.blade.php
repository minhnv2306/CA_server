@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Create new order
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="http://wipro-crm.local/news/news_category"> Order</a></li>
                <li class="active">Create new order</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="container">
                    <div class="row font-size-17">
                        <div class="col-sm-12">
                            <form id="form_cat_add" class="form-add-news-category" method="post"
                                  action="http://wipro-crm.local/order/orders" enctype="multipart/form-data">
                                <!-- /.box-header -->
                                <div class="box-body">


                                    <fieldset class="col-sm-12">
                                        <legend>Product information</legend>
                                        <div id="choose_product">
                                            <div class="row product">
                                                <div class="col-sm-12">
                                                    <table class="table table-responsive table-bordered">
                                                        <thead>
                                                        <th>Category product</th>
                                                        <th>Product</th>
                                                        <th>Number</th>
                                                        <th colspan="2">Action</th>
                                                        </thead>
                                                        <tbody id="body_files">
                                                        <tr class="tr_clone">
                                                            <td>
                                                                <div class="form-group">
                                                                    <select class="js-example-basic-single"
                                                                            id="cate_product" style="width: 100%"
                                                                            onchange="myFunction()">
                                                                        <option value="1">Sữa rửa mặt</option>
                                                                        <option value="2">Nước hoa hồng</option>
                                                                        <option value="3">Serum</option>
                                                                        <option value="4">Xịt khoáng</option>
                                                                        <option value="5">Dưỡng ẩm ban ngày</option>
                                                                        <option value="6">Dưỡng ẩm ban đêm</option>
                                                                        <option value="7">Dưỡng da Moiturizer</option>
                                                                        <option value="8">Nhóm khác</option>
                                                                        <option value="9">Mặt nạ ngủ</option>
                                                                    </select>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="form-group" id="display_products">
                                                                    <div class="form-group">
                                                                        <select class="js-example-basic-single"
                                                                                name="products" id="products1"
                                                                                style="width: 100%">
                                                                            <option value="45">BIO SRM DUONG TRANG TANAKA 100G</option>
                                                                            <option value="46">BIO GEL TAY TE BAO CHET SUA ONG CHUA+ATP 60G</option>
                                                                            <option value="47">BIO SRM CHO DA KHO SUA ONG CHUA+ATP 100G</option>
                                                                            <option value="48">BIO SRM CHO DA DAU SUA ONG CHUA+ATP 100G</option>
                                                                            <option value="49">BIO SRM DUONG TRANG TO YEN COLAGEN 100G</option>
                                                                            <option value="50">BIO GEL TAY T/B CHET SUA ONG CHUA+ATP GOI 6G</option>
                                                                            <option value="51">BIO SRM DUONG TRANG TO YEN+PEPTIDE 100G</option>
                                                                            <option value="52">BIO GEL TAY TE BAO CHET SUA ONG CHUA+ATP 10G</option>
                                                                            <option value="53">BIO SRM DUONG TRANG TANAKA 100G</option>
                                                                            <option value="54">BIO SRM NN DAU HIEU LAO HOA NGAY 24K 100G</option>
                                                                            <option value="55">BIO SRM NN DAU HIEU LAO HOA DEM 24K 160G</option>
                                                                            <option value="56">BIO GEL TTBC SUA ONG CHUA CHO DA NHAY CAM 60G</option>
                                                                            <option value="57">BIO NUOC HOA HONG TANAKA 100ML</option>
                                                                            <option value="58">BIO NUOC HOA HONG SUA ONG CHUA+ATP 100ML</option>
                                                                            <option value="59">BIO NUOC HOA HONG TO YEN COLLAGEN 100ML</option>
                                                                            <option value="60">BIO NUOC CAN BANG DO AM TO YEN+PEPTIDE 100ML</option>
                                                                            <option value="61">BIO N/HOA HONG SUA ONG CHUA+ATP 100ML NO MIT</option>
                                                                            <option value="62">BIO N/C/BANG DO AM TO YEN+PEPTIDE 100ML NOMIT</option>
                                                                            <option value="63">BIO TINH CHAT DUONG TRANG TANAKA 30ML</option>
                                                                            <option value="64">BIO T/CHAT TRE HOA DA SUA ONG CHUA+ATP 40ML</option>
                                                                            <option value="65">BIO TINH CHAT TO YEN COLLAGEN 30ML</option>
                                                                            <option value="66">BIO T/CHAT D/TRANG &amp;P/HOI TO YEN+PEPTIDE 30ML</option>
                                                                            <option value="67">BIO NUOC DUONG NN DAU HIEU LAO HOA 24K 150ML</option>
                                                                            <option value="68">BIO N.DUONG CHIET XUAT VANG SINH HOC 24K 30ML</option>
                                                                            <option value="69">BIO NUOC XIT KHOANG MIRACLE BIO WATER 100ML</option>
                                                                            <option value="70">BIO NUOC XIT KHOANG MIRACLE BIO WATER 100ML</option>
                                                                            <option value="71">BIO NUOC XIT KHOANG MIRACLE BIO WATER 300ML</option>
                                                                            <option value="72">BIO NUOC XIT KHOANG MIRACLE BIO WATER 30ML</option>
                                                                            <option value="73">BIO KEM DUONG TRANG (NGAY) TANAKA 50G</option>
                                                                            <option value="74">BIO KEM DUONG TRANG (DEM) TANAKA 50G</option>
                                                                            <option value="75">BIO KEM NANG CO MAT SUA ONG CHUA+ATP 40G</option>
                                                                            <option value="76">BIO KEM DUONG TRANG TO YEN COLLAGEN (NGAY)50G</option>
                                                                            <option value="77">BIO KEM NANG CO MAT SUA ONG CHUA+ATP GOI 4G</option>
                                                                            <option value="78">BIO SUA ONG CHUA+ATP BO 3</option>
                                                                            <option value="79">BIO KEM DUONG TRANG TO YEN+PEPTIDE 50G</option>
                                                                            <option value="80">BIO KEM NANG CO MAT SUA ONG CHUA+ATP 40G</option>
                                                                            <option value="81">BIO KEM DUONG NNDH LAO HOA NGAY SPF25 24K 40G</option>
                                                                            <option value="82">BIO KEM DUONG NN DAU HIEU LAO HOA DEM 24K 40G</option>
                                                                            <option value="83">BIO MAT NA NGU TO YEN COLLAGEN (DEM) 60G</option>
                                                                            <option value="84">BIO MAT NA NGU TO YEN+PEPTIDE (DEM) 50G</option>
                                                                            <option value="85">BIO GEL TAY TBC SUA ONG CHUA+ATP GOI MAU THU 7/16</option>
                                                                            <option value="86">BIO KEM NANG CO MAT SOC+ATP GOI MAU THU</option>
                                                                            <option value="87">BIO GEL TAY TBC SUA ONG CHUA+ATP 10G TUYP THU</option>
                                                                            <option value="88">BIO GEL TAY TBC S/O/CHUA&amp;ATP 60G+BIO NXK 30ML</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="number" min="1" step="1" class="form-control"
                                                                       id="quantity" name="numbers" value="1" required>
                                                            </td>

                                                            <td style="width: 5%;" class="text-center">
                                                                <button type="button" id="add_product"
                                                                        class="btn btn-primary"><i
                                                                            class="fa fa-plus-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        <tfoot>
                                                        </tfoot>
                                                    </table>

                                                    <table class="table table-responsive table-bordered text-center product-table">
                                                        <thead>
                                                        <th>Category product</th>
                                                        <th>Product</th>
                                                        <th>Number</th>
                                                        <th>Action</th>
                                                        </thead>
                                                        <tbody id="body_products">

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
                                        <legend>Order status</legend>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sel1">Customer</label>
                                                    <select class="form-control" name="customer_id">
                                                        <option value=1> Nguyen
                                                            (tung@t.com)
                                                        </option>
                                                        <option value=2> Nameeeee
                                                            (test@gam123.com)
                                                        </option>
                                                        <option value=3> Test
                                                            (Test@gmail.com)
                                                        </option>
                                                        <option value=4> Vvu Hoai Nam
                                                            ()
                                                        </option>
                                                        <option value=5> Nguyen Xuan Khoi12312
                                                            (khoinx@paditech.org)
                                                        </option>
                                                        <option value=6> Lanhnt
                                                            (lanhnt@paditech.org)
                                                        </option>
                                                        <option value=7> Test01
                                                            (kenh14@gmail.com)
                                                        </option>
                                                        <option value=8> Test02
                                                            ()
                                                        </option>
                                                        <option value=9> Test03
                                                            ()
                                                        </option>
                                                        <option value=10> Test04
                                                            ()
                                                        </option>
                                                        <option value=12> Nguyen Van ABCD
                                                            ()
                                                        </option>
                                                        <option value=13> Test001
                                                            (lanhtest@paditech.org)
                                                        </option>
                                                        <option value=14> LanhTest
                                                            ()
                                                        </option>
                                                        <option value=15> Test002
                                                            ()
                                                        </option>
                                                        <option value=16> huy
                                                            (qhuy.2207@gmail.com)
                                                        </option>
                                                        <option value=17> Nguyen Tes01
                                                            (test01@gmail.com)
                                                        </option>
                                                        <option value=18> Nguyen Test 02
                                                            (test02@gmail.com)
                                                        </option>
                                                        <option value=19> Nguyen Local
                                                            (tests1@gmail.com)
                                                        </option>
                                                        <option value=20> Nguyen Tien Dong
                                                            (tung91996@gmail.com)
                                                        </option>
                                                        <option value=21> Nguyen Van A
                                                            ()
                                                        </option>
                                                        <option value=22> trinh
                                                            (tr@gmail.com)
                                                        </option>
                                                        <option value=23> nguyễn văn cường
                                                            (cuongnguyen@gmail.com)
                                                        </option>
                                                        <option value=24> test001
                                                            (test001@gmail.com)
                                                        </option>
                                                        <option value=25> test002
                                                            (test002@gmail.com)
                                                        </option>
                                                        <option value=26> tr
                                                            (yd@gmail.com)
                                                        </option>
                                                        <option value=27> test003
                                                            (test003@gmail.com)
                                                        </option>
                                                        <option value=28> tu
                                                            (o@gmail.com)
                                                        </option>
                                                        <option value=29> Nguyen Minh Duc
                                                            (ducnm@paditech.org)
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sel1">Payment status</label>
                                                    <select class="form-control" name="payment_status">
                                                        <option value="1">Pay</option>
                                                        <option value="0">Unpay</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="sel1">Order status</label>
                                                    <select class="form-control" name="order_status">
                                                        <option value="1">Pending</option>
                                                        <option value="0">Cancel</option>
                                                        <option value="2">Shipping</option>
                                                        <option value="3">Complete</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="sel1">Note order</label>
                                                    <textarea class="form-control" rows="5" name="note"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="col-sm-12">
                                        <legend>Billing information</legend>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="sel1">Billing address</label>
                                                    <textarea class="form-control" rows="5"
                                                              name="billing_address"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="sel1">Billing name</label>
                                                    <input type="text" class="form-control" name="billing_name">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="sel1">Billing phone</label>
                                                    <input type="number" class="form-control" name="billing_phone">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="sel1">Billing note</label>
                                                    <textarea class="form-control" rows="5" name="billing_note"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="sel1">Billing date</label>
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" name="billing_date"/>
                                                    <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <input type="hidden" name="_token" value="kFgVFvXK8p2kANnaE2qorC9gJSPHerRe3P8OEEXd">
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-primary"
                                                    onclick="if(!removeDisabled()) {return false;}">Save</button>
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