
    class Detail {
        constructor(btnID) {
            this.btnID = btnID; // ".btn-detail"
        }

        showDetail() {

            $(this.btnID).click(function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                id = parseInt(id);
                var data = {op:"showDetail", id:id};

                $.post("../controllers/controller.php",
                    { data:JSON.stringify(data)},
                    function (loadedData, textStatus, jqXHR) {
                        $("#body").html(loadedData);
                        
                    }
                );
            });
        }
    }
  

