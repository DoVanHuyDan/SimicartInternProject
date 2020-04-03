<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Update a Record - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>

  


    <div class="container">

        <div class="page-header">
            <h1>Creat New Product</h1>
        </div>

        <form action="../index.php?op=createnew" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' placeholder="name" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><textarea name='price' placeholder="price" class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td> buttun to upload file here <input name="image" value="img here"> </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <!--click save change will sent data with POST , then handle request will be call , op will be caught using GET-->
                        <input type='submit' value="Create New Product" class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back products page</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>