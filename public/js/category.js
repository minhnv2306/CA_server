
$(function() {
    table = $('#category_table').DataTable({
        processing: true,
        serverSide: true,
        bAutoWidth: true,
        searching: false,
        ajax: {
            url: 'news_category/get',
            type: 'get',
            data: function (d) {
                d.category = $('#category option:selected').val();
                d.checkHasChildren =$('input#checkHasChildren:checked').val();
                console.log(d.category);
                console.log(d.checkHasChildren);
            }
        },
        columns: [
            {data: 'id', sortable: false},
            {data: 'name',name:'news_cates.name'},
            {data: 'position',name:'news_cates.position'},
            {data: 'actions'}
        ],
        "language": {
        //     "lengthMenu": "Hiển thị _MENU_ bản ghi trên một trang",
        //     "zeroRecords": "Không tìm bản ghi phù hợp",
        //     "info": "Đang hiển thị trang _PAGE_ of _PAGES_",
        //     "infoEmpty": "Không có dữ liệu",
        //     "infoFiltered": "(lọc từ tổng số _MAX_ bản ghi)",
        //     "info": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ kết quả",
        //     "paginate": {
        //         "first":      "Đầu tiên",
        //         "last":       "Cuối cùng",
        //         "next":       "Sau",
        //         "previous":   "Trước"
        //     },
            "sProcessing": '<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading'
        },
    });
});
function filter(){
    table.draw();
}