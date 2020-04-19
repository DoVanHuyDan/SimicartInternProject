    <?php include_once(dirname(__DIR__) . '/assets/helper.php');

    $helper = new Helper();
    ?>


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
            <td><img src=<?php echo $helper->getURL() . "HornyMVC_AJAX_PHP/" . $record['image']; ?> alt="image for this product"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href=<?php echo $helper->getURL() . 'HornyMVC_AJAX_PHP/index.html'; ?> class='btn btn-danger' >Back To Product Page</a>
               
            </td>
        </tr>
    </table>