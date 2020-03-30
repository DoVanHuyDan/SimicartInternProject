<?php

spl_autoload_register('autoLoader');

function autoLoader($className)
{
    $path = "classes/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension;

    include_once $fullPath;

    if( !file_exists($fullPath) )
    {
        return false;
    }
}

?>