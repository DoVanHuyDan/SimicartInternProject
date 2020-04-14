<?php

    include_once(__DIR__ . '/helper.php');
    $helper = new Helper();
    // if user type http://localhost/HornyMVC/  or http://localhost/HornyMVC
    // then the server will try to find index.html / index.php to load automatically
    header("location: " . $helper->getURL() .  "HornyMVC/admin/list.html");
    
?>