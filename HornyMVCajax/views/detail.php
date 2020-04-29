<?php
require_once(dirname(__DIR__) . "/helper.php");
require_once(dirname(__DIR__) . "/Blocks/block.php");
$helper = new Helper();
$block = new Block();
// this file is included by controller, so we can get directly $id from there
$record = $block->getOneRecord($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORNYdetail</title>

    <link rel="stylesheet" href=<?php echo $helper->getURL() . '/HornyMVCajax/css/css.css'; ?>>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">

        <div class="page-header">
            <h1> Product Details</h1>
        </div>


        <table class='table table-hover table-responsive '>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($record['name'], ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?php echo htmlspecialchars($record['price'], ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <th>Image</th>
                <td><img src=<?php echo $helper->getURL() . "HornyMVCajax/" . $record['image']; ?> alt="image for this product"></td>
            </tr>
            <tr>
                <td></td>
                <td>

                    <a href=<?php echo $helper->getURL() . 'HornyMVCajax/admin/showAll'; ?> class='btn btn-danger back-to-list'>Back products page</a>

                </td>
            </tr>
        </table>
    </div>

</body>

</html>