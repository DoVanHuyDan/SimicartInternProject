<?php
include_once(dirname(__DIR__) . "/helper.php");
$helper = new Helper();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORNY</title>

    <link rel="stylesheet" href=<?php echo $helper->getURL() . 'HornyMVC/css/css.css'; ?>>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>

<body>



    <div class="container">

        <div class="page_header">
            <h1> All Products</h1>
        </div>




        <?php
        include_once(dirname(__DIR__) . "/models/dbinteractions.php");
        $dbinteraction = new DbInteractions();
        $allrecord = $dbinteraction->getAllRecords();
        ?>

        <!-- // if we have > 0 reocords -->
        <?php if (isset($allrecord)) : ?>

            <table class='table table-dark'>
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($allrecord as $record) : ?>
                        <?php extract($record);  ?>
                        <tr>
                            <th scope='row'><?php echo $id; ?></th>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $price ?></td>
                            <td>
                                <!-- // all links bellow + params will be sent by GET when click on any of these links
                                // read one record -->
                                <a href=<?php echo $helper->getURL() . 'HornyMVC/admin/detail/' . $id; ?> class='btn btn-info m-r-1em'>Detail</a>
                                <!-- // we will use this links on next part of this post -->
                                <a href=<?php echo $helper->getURL() . 'HornyMVC/admin/form/update/' . $id; ?> class='btn btn-primary m-r-1em'>Edit</a>

                                <!-- // we will use this links on next part of this post -->
                                <a href='#' onclick=<?php echo "delete_user(" .  $id . ",'" . $helper->getURL() . "')"; ?> class='btn btn-danger'>Delete</a>
                            </td>

                        </tr>
                    <?php endforeach ?>



                </tbody>

            </table>
        <?php else : ?>

            <div class="alert alert-danger" role="alert">
                <p>No product found!</p>
            </div>';
        <?php endif ?>

        <!-- // create a new product -->
        <a href=<?php echo $helper->getURL()  . 'HornyMVC/admin/form/createnew'; ?> class='btn btn-primary m-b-1em'>Create New </a>






    </div>

    <script type='text/javascript'>
        // confirm record deletion
        function delete_user(id, url) {

            var answer = confirm('Are you sure?');
            if (answer) {
                // if user clicked ok, 

                window.location = url + 'HornyMVC/admin/list.html/delete/' + id;
            }
        }
    </script>

</body>

</html>