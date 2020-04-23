<?php

class Helper
{

    function getURL()
    {
        // http://localhost/training/huy/HornyMVC/php.php 

        // $url =  isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://' .
        //     $_SERVER['SERVER_NAME'] . "/";

        $url =  isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://' .
            $_SERVER['HTTP_HOST'] . "/";

        // $url = http://localhost/
        $arr = explode("/", $_SERVER['REQUEST_URI']);
        // $_SERVER['REQUEST_URI'] = /training/huy/HornyMVC/php.php 
        // $arr = ("","training", "huy", "HornyMVC", "php.php")

        $arr = array_slice($arr, 0, array_search("HornyMVC", $arr));
        // $arr = ("","training", "huy") 
        foreach ($arr as $r) {
            if (!empty($r)) {
                $url =  $url . $r . "/";
            }
        }

        return $url; // http://localhost/training/huy/
    }


}


?>