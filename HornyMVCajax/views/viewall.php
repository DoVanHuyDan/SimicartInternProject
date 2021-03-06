<?php
require_once(dirname(__DIR__) . "/helper.php");
require_once(dirname(__DIR__) . "/Blocks/block.php");
$block = new Block();
$helper = new Helper();
$allrecord = $block->getAllRecords();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORNYviewall</title>

    <link rel="stylesheet" href=<?php echo $helper->getURL() . 'HornyMVCajax/css/css.css'; ?>>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--link to delete.js-->
    <script src="<?php echo $helper->getURL(); ?>HornyMVCajax/js/delete.js"></script>
    <!--link to update.js-->
    <script src="<?php echo $helper->getURL(); ?>HornyMVCajax/js/update.js"></script>
    <!--link to detial.js-->
    <script src="<?php echo $helper->getURL(); ?>HornyMVCajax/js/detail.js"></script>

    <script>
        $(document).ready(function() {
            var del = new Delete();
            del.deleteProduct(".btn-delete");
            var up = new Update();
            up.edit(".btn-edit");
            up.createNew("#create-new");
            var detail = new Detail(".btn-detail");
            detail.showDetail();

        });
    </script>

</head>

<body>
    <div class="container">

        <div class="page_header">
            <h1> All Products</h1>
        </div>
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

                                <!--FOR USING PURE PHP-->
                                <a style="display: none;" href=<?php echo $helper->getURL() . 'HornyMVCajax/admin/showDetail/' . $id; ?> class='btn btn-info m-r-1em'>Detail</a>
                                <!--FOR USING PURE PHP-->
                                <a style="display: none;" href=<?php echo $helper->getURL() . 'HornyMVCajax/admin/form/update/' . $id; ?> class='btn btn-primary m-r-1em'>Edit</a>
                                <!--FOR USING PURE PHP-->
                                <a style="display: none;" href='#' onclick=<?php echo "delete_user(" .  $id . ",'" . $helper->getURL() . "')"; ?> class='btn btn-danger'>Delete</a>




                                <!--FOR USING AJAX-->
                                <button id=<?php echo $id; ?> class='btn btn-info m-r-1em btn-detail'>Detail</button>
                                <!--FOR USING AJAX-->
                                <button id=<?php echo $id; ?> class='btn btn-primary m-r-1em btn-edit'>Edit</button>
                                <!--FOR USING AJAX-->
                                <button id=<?php echo $id; ?> class='btn btn-danger btn-delete'>Delete</button>
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

        <!--FOR USING AJAX-->
        <button  class='btn btn-primary m-b-1em' id="create-new">Create New</button>
        <!--FOR USING PURE PHP-->
        <a style="display: none;" href=<?php echo $helper->getURL()  . 'HornyMVCajax/admin/form/createnew'; ?> class='btn btn-primary m-b-1em'>Create New </a>

    </div>
    <!--FOR USING PURE PHP-->
    <script type='text/javascript'>
        // confirm record deletion
        function delete_user(id, url) {

            var answer = confirm('Are you sure?');
            if (answer) {
                // if user clicked ok, 

                window.location = url + 'HornyMVCajax/admin/delete/' + id;
            }
        }
    </script>

</body>

</html>