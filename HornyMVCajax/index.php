<?php
require_once(__DIR__ . '/router.php');
?>
<div id="body">
    <?php
    $router = new Router();
    $router->routing();
    ?>
</div>