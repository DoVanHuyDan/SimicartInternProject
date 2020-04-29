<?php

class Helper
{

    function getURL()
    {
        // http://localhost/training/huy/HornyMVCajax/php.php 

        // $url =  isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://' .
        //     $_SERVER['SERVER_NAME'] . "/";

        $url =  isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://' .
            $_SERVER['HTTP_HOST'] . "/";

        // $url = http://localhost/
        $arr = explode("/", $_SERVER['REQUEST_URI']);
        // $_SERVER['REQUEST_URI'] = /training/huy/HornyMVCajax/php.php 
        // $arr = ("","training", "huy", "HornyMVCajax", "php.php")

        $arr = array_slice($arr, 0, array_search("HornyMVCajax", $arr));
        // $arr = ("","training", "huy") 
        foreach ($arr as $r) {
            if (!empty($r)) {
                $url =  $url . $r . "/";
            }
        }

        return $url; // http://localhost/training/huy/
    }

    public function deleteImage($path)
    {   
        if (unlink( __DIR__ . '/' . $path)) { // full url to image
            // delete successfully
        } else {
            echo "you have an error deleting image of your product";
        }
    }





    public function uploadFile()
    {
        // if users do not upload any file -> return null
        if (empty($_FILES['image']['size'])) {

            return null;
        } else {

            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];



            $fileEXT = explode('.', $fileName);
            $actuallfileEXT = strtolower(end($fileEXT));

            $allowed = array('png', 'jpg', 'jpeg', 'pdf');
            if (in_array($actuallfileEXT, $allowed)) {
                if ($fileError === 0) {

                    if ($fileSize < 10000000) {
                        // uniqid method to creat unique number , then we will never have same file names
                        $fileNameNew = uniqid('', true) . '.' . $actuallfileEXT;
                        $destinationFolder =  'upload/' . $fileNameNew;

                        // uploadfile 
                        move_uploaded_file($fileTmpName, __DIR__. '/' . $destinationFolder);
                        ///     header("location : php.php");
                        return $destinationFolder;
                    } else {
                        echo 'your file is too big';
                    }
                } else {
                    echo 'there is an error uploading your file!';
                }
            } else {
                echo 'your file is not allowed to upload!';
            }
        }
    }
}
