$(document).ready(function () {

    $('#choose_product').on('click', '.delete', function (e) {
        $(this).parents("tr").remove();
    })
})