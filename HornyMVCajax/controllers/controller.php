<?php

include_once(dirname(__DIR__) . "/models/dbinteractions.php");
include_once(dirname(__DIR__) . "/helper.php");

class Controller extends DbInteractions
{


    public function pageNotFound()
    {
        include_once(dirname(__DIR__) . "/views/404-notfound-page.html");
    }

    public function showAll()
    {
        include_once(dirname(__DIR__) . "/views/viewall.php");
    }

    public function showDetail($id)
    {
        include_once(dirname(__DIR__) . "/views/detail.php");
    }

    public function showUpdateForm($id = null)
    {
        include_once(dirname(__DIR__) . "/views/update.php");
    }

    

    public function save($id = '', $name, $price, $oldImage = '')
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
                    header("location:" . $helper->getURL() .  "HornyMVCajax/admin/list.html");
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
                    header("location:" . $helper->getURL() .  "HornyMVCajax/admin/list.html");
                    exit();
                }
            }
        }
    }


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



    public function handleRequests($data)
    {
        $op = $data['op'];
        switch ($op) {
            case '404':
                $this->pageNotFound();
                break;

            case 'showAll':
                $this->showAll();
                break;

            case 'showDetail':
                $this->showDetail($data['id']);
                break;

            case 'createnew':
                $this->showUpdateForm();
                break;

            case 'update':
                $this->showUpdateForm($data['id']);
                break;

            case 'save':
                $this->save('', $data['name'], $data['price'], '');
                break;

            case 'delete':
                $this->deleteOneRecord($data['id']);
                break;

            case 'updateChange':
                $this->save($data['id'], $data['name'], $data['price'], $data['oldImage']);
                break;
        }
    }
}







// handle request frorm AJAX


$controller = new Controller();
if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'detail':
            $controller->showDetail($_POST['id']);
            break;
        case 'delete':
            $controller->deleteOneRecord($_POST['id']);
            break;
        case 'edit':
            $controller->showUpdateForm($_POST['id']);
            break;
        case 'createnew':
            $controller->showUpdateForm();
            break;
        case 'save':
            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = trim($_POST['price']);
            $oldImage = $_POST['oldImage'];


            // handle form if it is not valid
            $emptyvalue = false;
            $invalidPrice = false;

            if (empty($price) || empty($name)) {
                $emptyvalue = true;
            }
            if (!is_numeric($price)) {
                $invalidPrice = true;
            }
            if (empty($id)) // create new product
            {
                if (empty($_FILES)) {
                    $emptyvalue = true;
                }
            }


            if (!$emptyvalue && !$invalidPrice) {

                $controller->save($id, $name, $price, $oldImage);
            }
            else 
            {
                echo $emptyvalue ? " error_ empty <br>" : "";
                echo $invalidPrice ? " error_ invalidprice" : "";
            }
            break;
        default:
            break;
    }
}
