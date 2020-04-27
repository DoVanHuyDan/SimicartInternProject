

    class Update {


        edit(btnClass) {

            $(btnClass).click(function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                id = parseInt(id);
                var data = { "op": "update", "id": id };
                data = JSON.stringify(data);
                $.post("../controllers/controller.php",
                    { data: data },
                    function (loadeddata, textStatus, jqXHR) {
                        $("#body").html(loadeddata);
                    }
                );
            });
        }


        createNew(btnID) {

            // CREATE  NEW 
            $(btnID).click(function () {

                var data = { "op": "createnew" };
                data = JSON.stringify(data);
                $.post("../controllers/controller.php", {
                    data: data
                }, function (loadeddata, status) {

                    $("#body").html(loadeddata);

                });
            });
        }



        updateChange(btnID) {

            // SUBMIT (Save + update changes)
            $(btnID).click(function () {

                var id = $("#id").text();
                id = parseInt(id);
                var name = $("#name").val();
                var price = $("#price").val();
                price = parseInt(price);
                var oldImage = $("#oldImage").val();
                var files = $('#newImage').prop('files');
                
                var data = {"id":id, "name":name, "price":price, "oldImage":oldImage , "op":"updateChange"};
                data = JSON.stringify(data);
                

                var formData1 = new FormData();
                formData1.append("image",files[0]); // key = image , value = files[0] , key needs to be the same as x with $_FILES['x']['size']) in helper.php
                formData1.append("data", data);
                
                $.ajax({
                    url: "../controllers/controller.php",
                    type: "POST",
                    data: formData1,
                    enctype: 'multipart/form-data',
                    processData: false, // tell jQuery not to process the data
                    contentType: false // tell jQuery not to set contentType
                }).done(function (data) {
                     location.reload();
                });
            
            });
        }
    }


