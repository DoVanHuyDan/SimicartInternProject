<?php include_once( dirname(__DIR__) . '/assets/helper.php' );
        $helper = new Helper();
        $action  = isset($id) ? "updateChange" : "saveNew";
 ?>

 <form action="" method="POST" enctype="multipart/form-data">
            <table class='table table-hover table-responsive '>
               <?php if(isset($id)):?>
                <tr>
                    <td>ID</td>
                    <td id="id"><?php echo $record['id'];?></td>
                </tr>
               <?php endif;?>
                <tr>
                    <td>Name</td>
                    <!--if $id is set / exsits means that update method has been called from controller then we show value of Record with id = $id here-->
                    <td><input type='text' id="name" name='name' value="<?php echo isset($id) ? htmlspecialchars($record['name'], ENT_QUOTES) : '';  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><textarea id="price" name='price' class='form-control'><?php echo isset($id) ? htmlspecialchars($record['price'], ENT_QUOTES) : '';  ?></textarea></td>
                </tr>


                <tr>
                    <td>Image</td>
                    <!--if we are creating a new product - > upload img-->
                    <?php if ($action == 'saveNew') : ?>
                        <td><input name="image" type="file" accept="image/*"></td>
                    <?php elseif( $action == 'updateChange' ) : ?>
                        <!-- // create a non-display input to save and pass the path of product's image to controller's update function -->
                        <td>
                            <img src=<?php echo $helper->getURL() . "HornyMVC_AJAX_PHP/" . $record['image']; ?> alt="image here">
                            <input id="oldImage" type="text" style="display: none" value=<?php echo $record['image']; ?> name="oldImage">
                            <span>you can choose other image here</span>
                            <input name="image" type="file" accept="image/*">
                        </td>
                    <?php endif; ?>
                </tr>


                <tr>
                    <td></td>
                    <td>
                        <?php if ($action == 'updateChange') : ?>
                            <input type='submit' value='Save Changes' id="btn-save" class='btn btn-primary' />
                        <?php elseif ($action == 'saveNew') : ?>
                            <input type='submit' value='Create New Product' class='btn btn-primary' />
                        <?php endif; ?>
                        <!--click save change / create new product will sent data with POST , then handle request will be call-->
                        <a href=<?php echo $helper->getURL() . 'HornyMVC_AJAX_PHP/index.html'; ?> class='btn btn-danger'>Back products page</a>
                    </td>
                </tr>
            </table>
        </form>