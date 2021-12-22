<?php
require_once(dirname(__DIR__) . "/helper.php");
require_once(dirname(__DIR__) . "/Blocks/block.php");
$helper = new Helper();
$block = new Block();

$action = '';
$param = ''; // parameter to pass in URL when submit the form bellow
//  SET UP action 
if (empty($id)) // if $id == null means that op = create new record ,not update any curent one 
{                   // just pass $id from controller when updating
    $action = 'saveNew';
    $actionOfForm = $helper->getURL() . 'HornyMVCajax/admin/form/updateChange';
    // http://localhost/HornyMVCajax/admin/form/updateChange
} else {
    $action = 'updateChange';
    // this file is included by controller, so we can get directly $if from there
    $record = $block->getOneRecord($id);
    $actionOfForm =  $helper->getURL() . 'HornyMVCajax/admin/form/updateChange/' . $id;
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Hornydupdate</title>

    <!-- Latest compiled and minified Bootstrap CSS -->

    <link rel="stylesheet" href=<?php echo $helper->getURL() . "HornyMVCajax/css/css.css"; ?>>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--link to update.js-->
    <script src="<?php echo $helper->getURL(); ?>HornyMVCajax/js/update.js"></script>

    <script>
        $(document).ready(function() {

            var up = new Update();
            up.updateChange(".btn-submit");
        });
    </script>
</head>

<body>
    <div class="container">

        <div class="page-header">
            <?php if ($action == 'updateChange') : ?>
                <h1>Update Product</h1>
            <?php else : ?>
                <h1>Create New Product</h1>
            <?php endif; ?>
        </div>

        <!--action inform should e absolute path , like bellow  -->
        <!--FOR USING PURE PHP-->
        <!-- <form action="<?php echo  $actionOfForm; ?>" method="POST" enctype="multipart/form-data"> -->
            <table class='table table-hover table-responsive '>
                <?php if ($action == 'updateChange') : ?>
                    <tr>
                        <td>ID</td>
                        <td id="id"><?php echo $record['id']; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td>Name</td>
                    <!--if $id is set / exsits means that update method has been called from controller then we show value of Record with id = $id here-->
                    <td><input id="name" type='text' name='name' value="<?php echo isset($id) ? htmlspecialchars($record['name'], ENT_QUOTES) : '';  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><textarea id="price" name='price' class='form-control'><?php echo isset($id) ? htmlspecialchars($record['price'], ENT_QUOTES) : '';  ?></textarea></td>
                </tr>


                <tr>
                    <td>Image</td>
                    <!--if we are creating a new product - > upload img-->
                    <?php if ($action == 'saveNew') : ?>
                        <td><input id="newImage" name="image" type="file" accept="image/*"></td>
                    <?php elseif ($action == 'updateChange') : ?>
                        <!-- // create a non-display input to save and pass the path of product's image to controller's update function -->
                        <td>
                            <img src=<?php echo $helper->getURL() . "HornyMVCajax/" . $record['image']; ?> alt="image here">
                            <input id="oldImage" type="text" style="display: none" value=<?php echo $record['image']; ?> name="oldImage">
                            <span>you can choose other image here</span>
                            <input id="newImage" name="image" type="file" accept="image/*">
                        </td>
                    <?php endif; ?>
                </tr>


                <tr>
                    <td></td>
                    <td>
                        <?php if ($action == 'updateChange') : ?>
                            <!-- FOR USING PURE PHP -->
                            <input style="display: none;" type='submit' value='Save Changes' class='btn btn-primary' />
                            <!--FOR USING AJAX-->
                            <button class='btn btn-primary btn-submit'>Update Change</button>
                        <?php elseif ($action == 'saveNew') : ?>
                            <!-- FOR USING PURE PHP -->
                            <input style="display: none;" type='submit' value='Create New Product' class='btn btn-primary' />
                            <!--FOR USING AJAX-->
                            <button class='btn btn-primary btn-submit'>Create New Product</button>
                        <?php endif; ?>
                        <!--click save change / create new product will sent data with POST , then handle request will be call-->

                        <a href=<?php echo $helper->getURL() . 'HornyMVCajax/admin/showAll'; ?> class='btn btn-danger'>Back products page</a>

                    </td>
                </tr>
            </table>
            <!--FOR USING PURE PHP-->
        <!-- </form> -->
    </div>
</body>

</html>