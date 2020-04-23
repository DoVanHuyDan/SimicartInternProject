
$(document).ready(function () {


    $(".btn-edit").click(function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $.post("../controllers/controller.php",
            { op: 'edit', id: id },
            function (data, textStatus, jqXHR) {
                $("#body").html(data);
            }
        );
    });

    // CREATE  NEW 
    $("#create-new").click(function () {

        $.post("../controllers/controller.php", {
            op: 'createnew'
        }, function (data, status) {

            $("#body").html(data);

        });
    });
    // BACK TO LIST 
    $(".back-to-list").click(function () {

        $.post("../controllers/controller.php", {
            op: 'back-to-list'
        }, function (data, status) {
            location.reload();
        });

    });
    // SUBMIT
    $(".btn-submit").click(function () {
        
        var id = $("#id").text();
        var name = $("#name").val();
        var price = $("#price").val();
        var oldImage = $("#oldImage").val();

        var uploadedFile = $('#newImage').prop('files');
        var formData1 = new FormData();

        formData1.append('id', id);
        formData1.append('name', name);
        formData1.append('price', price);
        formData1.append('oldImage', oldImage);
        formData1.append('image', uploadedFile[0]);
        formData1.append('op', 'save');
        $("").addClass('.error');
        $.ajax({
            url: "../controllers/controller.php",
            type: "POST",
            data: formData1,
            enctype: 'multipart/form-data',
            processData: false, // tell jQuery not to process the data
            contentType: false // tell jQuery not to set contentType
        }).done(function (data) {
            if( String(data).search('error_') != -1 )
            {
                alert(data);
            }
            else
            {   
                // if no error found -> reload to go back list of product
                location.reload();
            }
        });

    });
});
