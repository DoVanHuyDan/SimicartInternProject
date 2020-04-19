$(document).ready(function () {
    // read all products
    var limit = 2;
    $("#page-title").text("All Products");

    $("#content").load(
        "controllers/read.php",
        { limit: limit },
        function () {
            // read one product  , after loading , we can use loaded elements as normal
            $(".btn-detail").click(function (e) {
                e.preventDefault();
                // hide load more and create new product buttons at index.html
                $("#btn-load-more").hide();
                $("#btn-create").hide();
                // get id of product from value = id of button element
                var id = $(this).val();
                $("#page-title").text("Product Details");
                $("#content").load("controllers/read_once.php", { id: id })
            });

            // edit product 
            $(".btn-edit").click(function () {
                // hide load more and create new product buttons at index.html
                $("#btn-load-more").hide();
                $("#btn-create").hide();
                var id = $(this).val();
                $("#page-title").text("Edit Product");
                $("#content").load(
                    "controllers/create_update.php",
                    { id: id },
                    function () { 
                        $("#btn-save").click(function (e) { 
                            e.preventDefault(); // to prevent button from submitting form as usual
                            var id = $("#id").text();
                            var name = $("#name").val();
                            var price = $("#price").val();
                            var oldImage = $("#oldImage");

                        });
                     });
            });



        }
    );

    // code in this section will be the same as above
    $("#btn-load-more").click(function (e) {

        e.preventDefault();
        limit = limit + 2;
        $("#content").load(
            "controllers/read.php",
            { limit: limit },
            function () {
                // read one product  , after loading , we can use loaded elements as normal
                $(".btn-detail").click(function (e) {
                    e.preventDefault();
                    // hide load more and create new product buttons at index.html
                    $("#btn-load-more").hide();
                    $("#btn-create").hide();
                    // get id of product from value = id of button element
                    var id = $(this).val();
                    $("#page-title").text("Product Details");
                    $("#content").load(
                        "controllers/read_once.php",
                        { id: id }
                    )
                });
            }

        );
    });

    // create new product
    $("#btn-create").click(function (e) {
        e.preventDefault();
        $("#page-title").text("Create New Product");
        $("#content").load("controllers/create_update.php");
    });

}); 