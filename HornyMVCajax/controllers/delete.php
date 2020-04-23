<?php

include_once(dirname(__DIR__) . "/models/dbinteractions.php");
include_once(dirname(__DIR__) . "/helper.php");

class Delete extends DbInteractions
{


    public function deleteOneRecord($id)
    {
        $helper = new Helper();
        $helper->deleteImage($this->getOneRecord($id)['image']);
        $this->deleteRecord($id);
        // after delete, show all products 

        if (!headers_sent()) {
            header("location: " . $helper->getURL() .  "HornyMVCajax/admin/list.html");
            exit();
        }
        // include_once 'views/viewall.php';
    }
}
