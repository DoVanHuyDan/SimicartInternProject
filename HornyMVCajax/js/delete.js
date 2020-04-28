class Delete
    {
        deleteProduct(btnClass)
        {
            $(btnClass).click(function () {
                var answer = confirm('delete this one?');
                if (answer) {
                    var id = $(this).attr('id');
                    id = parseInt(id);
                    var data = {"op":"delete", "id":id};
                    data = JSON.stringify(data);
                    // this js file would be linked in view all 
                    $.post('../controllers/controller.php',
                        { data:data},
                        function (loadeddata, status) {
                            location.reload();
                        }
                    );
                }
            });
        }
    }
