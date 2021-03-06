<?php
include_once(dirname(__DIR__) . "/helper.php");
$helper = new Helper();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Horny</title>

    <!-- Latest compiled and minified Bootstrap CSS -->

    <link rel="stylesheet" href=<?php echo $helper->getURL() . "HornyMVC/css/css.css"; ?>>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>



    <?php
    $action = '';
    $param = ''; // parameter to pass in URL when submit the form bellow
    include_once(dirname(__DIR__) . "/models/dbinteractions.php");

    $dbinteraction = new DbInteractions();


    //  SET UP action 
    if (empty($id)) // if $id == null means that op = create new record ,not update any curent one 
    {                   // just pass $id from controller when updating
        $action = 'saveNew';
        $actionOfForm = $helper->getURL() . 'HornyMVC/admin/form/save';
        // http://localhost/HornyMVC/admin/form/save
    } else {
        $action = 'updateChange';
        // this file is included by controller, so we can get directly $if from there
        $record = $dbinteraction->getOneRecord($id);
        $actionOfForm =  $helper->getURL() . 'HornyMVC/admin/form/updateChange/' . $id;
    }




    ?>



    <div class="container">

        <div class="page-header">
            <?php if ($action == 'updateChange') : ?>
                <h1>Update Product</h1>
            <?php else : ?>
                <h1>Create New Product</h1>
            <?php endif; ?>
        </div>

        <!--action inform should e absolute path , like bellow  -->
        <form action="<?php echo  $actionOfForm; ?>" method="POST" enctype="multipart/form-data">
            <table class='table table-hover table-responsive '>
                <tr>
                    <td>Name</td>
                    <!--if $id is set / exsits means that update method has been called from controller then we show value of Record with id = $id here-->
                    <td><input type='text' name='name' value="<?php echo isset($id) ? htmlspecialchars($record['name'], ENT_QUOTES) : '';  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><textarea name='price' class='form-control'><?php echo isset($id) ? htmlspecialchars($record['price'], ENT_QUOTES) : '';  ?></textarea></td>
                </tr>


                <tr>
                    <td>Image</td>
                    <!--if we are creating a new product - > upload img-->
                    <?php if ($action == 'saveNew') : ?>
                        <td><input name="image" type="file" accept="image/*"></td>
                    <?php elseif( $action == 'updateChange' ) : ?>
                        <!-- // create a non-display input to save and pass the path of product's image to controller's update function -->
                        <td>
                            <img src=<?php echo $helper->getURL() . "HornyMVC/" . $record['image']; ?> alt="image here">
                            <input type="text" style="display: none" value=<?php echo $record['image']; ?> name="oldImage">
                            <span>you can choose other image here</span>
                            <input name="image" type="file" accept="image/*">
                        </td>
                    <?php endif; ?>
                </tr>


                <tr>
                    <td></td>
                    <td>
                        <?php if ($action == 'updateChange') : ?>
                            <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <?php elseif ($action == 'saveNew') : ?>
                            <input type='submit' value='Create New Product' class='btn btn-primary' />
                        <?php endif; ?>
                        <!--click save change / create new product will sent data with POST , then handle request will be call-->
                        <a href=<?php echo $helper->getURL() . 'HornyMVC/admin/showAll'; ?> class='btn btn-danger'>Back products page</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>