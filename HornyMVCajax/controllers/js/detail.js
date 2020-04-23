$(document).ready(function () {
    $(".btn-detail").click(function (e) { 
        e.preventDefault();
        var id = $(this).attr('id');
        $.post("../controllers/controllerAJAX.php", 
            { op:'detail', id:id},
            function (data, textStatus, jqXHR) {
                $("#body").html(data);
            }
        );
    });
});