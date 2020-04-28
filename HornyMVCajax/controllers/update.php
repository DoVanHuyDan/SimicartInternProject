<?php

include_once(dirname(__DIR__) . "/models/dbinteractions.php");
include_once(dirname(__DIR__) . "/helper.php");

class Update extends DbInteractions
{
    public function showUpdateForm($id = null)
    {
        include_once(dirname(__DIR__) . "/views/update.php");
    }



    public function save($id = '', $name, $price, $oldImage = '', $file='')
    {
        $helper = new Helper();
        // image links if use is creating new product / update , gotten from updateForm
        $newImage = $helper->uploadFile();
      

        if (empty($id)) // $id empty -> creating new product, otherwise -> update
        {
            if (empty($name) || empty($price) || empty($newImage)) {   // if any of fields is emty - > go back to create new product page
                if (!headers_sent()) {
                    header("location:" . $helper->getURL() . "HornyMVCajax/admin/form/createnew");
                    exit();
                }
            } else {
                $this->createNewRecord($newImage, $name, $price);
                // after created , show all

                if (!headers_sent()) {
                    header("location:" . $helper->getURL() .  "HornyMVCajax/admin/showAll");
                    exit();
                }
            }
        } else {  // update product , and no new image has been uploaded
            if (empty($name) || empty($price)) {
                if (!headers_sent()) {

                    header("location:" . $helper->getURL() .  "HornyMVCajax/admin/form/update/$id");
                    exit();
                }
            } else {
                if (empty($newImage)) // if use does not update any img when editing product
                {
                    $this->updateOneRecord($id, $oldImage, $name, $price);
                } else {
                    // delete old oldImage if user uploaded new image
                    $helper->deleteImage($oldImage);
                    $this->updateOneRecord($id, $newImage, $name, $price);
                }
                // after all , show list
                if (!headers_sent()) {
                    header("location:" . $helper->getURL() .  "HornyMVCajax/admin/showAll");
                    exit();
                }
            }
        }
    }
}
