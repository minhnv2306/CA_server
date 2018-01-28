<div aria-hidden="false" aria-labelledby="mySmallModalLabel" role="dialog" class="modal fade in" id="detailModal"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 id="finishModalLabel" class="modal-title">Cập nhật dữ liệu</h4>
            </div>
            <div id='modal_content' class="modal-body"></div>
        </div>
    </div>
</div>


<!-- jQuery 3 -->
<script src="http://cert.local/admin-lte/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="http://cert.local/admin-lte/bootstrap/js/bootstrap.min.js"></script>
<script src="http://cert.local/admin-lte/plugins/jqueryValidation/jquery.validate.min.js"></script>
<script src="http://cert.local/js/notify.min.js"></script>

<!-- Bootstrap core JavaScript -->


<script src="http://cert.local/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://cert.local/admin-lte/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script src="http://cert.local/js/prism.js"></script>

<!--Icheck-->
<script src="http://cert.local/admin-lte/plugins/iCheck/icheck.min.js"></script>
<!--bootstrap tab-->
<script src="http://cert.local/admin-lte/tag/bootstrap-tagsinput.js"></script>
<!-- Select 2 -->
<script src="http://cert.local/admin-lte/plugins/select2/select2.js"></script>
<script src="http://cert.local/admin-lte/dist/js/moment-with-locales.min.js"></script>
<!-- AdminLTE App -->
<script src="http://cert.local/admin-lte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="http://cert.local/admin-lte/dist/js/bootstrap-datetimepicker.min.js"></script>
<!-- Include Date Range Picker -->
<script src="http://cert.local/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
<script src="http://cert.local/admin-lte/plugins/waitMe/waitMe.js"></script>
<script src="http://cert.local/admin-lte/dist/js/adminlte.min.js"></script>
<script src="http://cert.local/admin-lte/dist/js/custom.js?v=1"></script>
<script src="http://cert.local/js/init.js?v=1"></script>
<script src="http://cert.local/admin-lte/plugins/viewbox/jquery.viewbox.js"></script>
<script src="http://cert.local/admin-lte/plugins/gdoc/jquery.gdocsviewer.min.js"></script>
<!--chart js-->
<script src="http://cert.local/admin-lte/plugins/chartjs/Chart.min.js"></script>
<script src="http://cert.local/admin-lte/plugins/flot/jquery.flot.js"></script>
<script src="http://cert.local/admin-lte/plugins/flot/jquery.flot.resize.js"></script>
<script src="http://cert.local/admin-lte/plugins/flot/jquery.flot.pie.js"></script>
<script src="http://cert.local/admin-lte/plugins/flot/jquery.flot.categories.js"></script>
<script src="http://cert.local/js/googlemap.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
        });
    });
</script>


<script src="http://cert.local/js/category.js"></script>
<script src="http://cert.local/js/order/add_product.js"></script>
<script src="http://cert.local/js/order/delete_product.js"></script>
<script src="http://cert.local/js/order/total_money.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('.data_table').DataTable();
        $('#date-start').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: 'true'
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            console.log(startDate);
            $('#date-end').datepicker('setStartDate', startDate);
        });
        $('#date-end').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: 'true'
        });
        $('#start').click(function () {
            $('#date-start').datepicker("show");
        });
        $('#end').click(function () {
            $('#date-end').datepicker("show");
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#save').click(function (e) {
            e.preventDefault();
            var allTbs = document.getElementsByName("products[]");

            for (i = 0; i < allTbs.length; i++) {
                products[$]
            }
            console.log(allTbs[0].value);
        })
    })
</script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<link rel='stylesheet' type='text/css' property='stylesheet'
      href='//wipro-crm.local/_debugbar/assets/stylesheets?v=1516007248'>
<script type='text/javascript' src='//wipro-crm.local/_debugbar/assets/javascript?v=1516007248'></script>
<script type="text/javascript">jQuery.noConflict(true);</script>