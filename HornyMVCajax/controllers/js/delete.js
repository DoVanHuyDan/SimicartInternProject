
$(document).ready(function () {
    $(".btn-delete").click(function () {
        var answer = confirm('delete this one?');
        if (answer) {
            var id = $(this).attr('id');
            // this js file would be linked in view all 
            $.post('http://localhost/HornyMVCajax/controllers/controller.php',
                { op: 'delete', id: id },
                function (data, status) {
                    location.reload();
                }
            );
        }
    });
});