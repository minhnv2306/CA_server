var datatable;
var _data = [];
var check = $("#check").val();

if (check != "true") {
    getListOrder(5);
    datatable = $('#listOrder').DataTable({
        data: _data
    });
} else {
    datatable = $('#listOrder').DataTable();
    check = "true";
}
$(function () {
    $('.filterStatus').click(function () {
        getListOrder($(this).data("status"));
    });
})
var payment = ["Unpay", "Pay"];
var statusBtn = [
    '<span class="label label-danger">Cancel</span>',
    '<span class="label label-warning">Pending</span>',
    '<span class="label label-primary">Shipping</span>',
    '<span class="label label-success">Complete</span>',
];

function getListOrder(status) {
    if (datatable)
        datatable.clear().draw();
    $.ajax({
        url: '/order/ajax/' + status,
        beforeSend: function () {
            $('#listOrder').waitMe({
                effect : 'bounce',
                text : '',
                bg : 'rgba(255,255,255,0.7)',
                color : '#000'
            });
        },
        success: function (data) {
            $('#listOrder').waitMe('hide');
            // xu ly data
            data.forEach(function (m) {
                m.order_status = statusBtn[m.order_status];
                m.payment_status = payment[m.payment_status];
                m.money = m.money.toLocaleString();
                m.created_id = '<a href="/order/orders/' + m.id + '" id="edit" class="btn btn-primary btn-xs">'
                    + '<i class="fa fa-pencil"> View Detail</i></a>';
                _data.push(Object.values(m));
            });

            datatable.rows.add(_data); // Add new data
            datatable.columns.adjust().draw(); // Redraw the DataTable
            datatable.order([0, 'desc']).draw();
            _data.length = 0;
        }
    });
}