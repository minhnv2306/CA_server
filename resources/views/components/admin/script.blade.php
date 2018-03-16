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
<script src="/admin-lte/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin-lte/bootstrap/js/bootstrap.min.js"></script>
<script src="/admin-lte/plugins/jqueryValidation/jquery.validate.min.js"></script>

<!-- Bootstrap core JavaScript -->


<script src="/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin-lte/plugins/datatables/dataTables.bootstrap.min.js"></script>


<!--Icheck-->
<script src="/admin-lte/plugins/iCheck/icheck.min.js"></script>
<!--bootstrap tab-->
<script src="/admin-lte/tag/bootstrap-tagsinput.js"></script>
<!-- Select 2 -->
<script src="/admin-lte/plugins/select2/select2.js"></script>
<script src="/admin-lte/dist/js/moment-with-locales.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin-lte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/admin-lte/dist/js/bootstrap-datetimepicker.min.js"></script>
<!-- Include Date Range Picker -->
<script src="/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/admin-lte/plugins/waitMe/waitMe.js"></script>
<script src="/admin-lte/dist/js/adminlte.min.js"></script>
<script src="/admin-lte/dist/js/custom.js?v=1"></script>
<script src="/admin-lte/plugins/viewbox/jquery.viewbox.js"></script>
<script src="/admin-lte/plugins/gdoc/jquery.gdocsviewer.min.js"></script>
<!--chart js-->
<script src="/admin-lte/plugins/chartjs/Chart.min.js"></script>
<script src="/admin-lte/plugins/flot/jquery.flot.js"></script>
<script src="/admin-lte/plugins/flot/jquery.flot.resize.js"></script>
<script src="/admin-lte/plugins/flot/jquery.flot.pie.js"></script>
<script src="/admin-lte/plugins/flot/jquery.flot.categories.js"></script>
<script src="/js/toastr.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
        });
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('.data_table').DataTable({
            "order": [[ 0, "desc" ]],
        });
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


