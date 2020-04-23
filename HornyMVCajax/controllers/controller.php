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

    public function deleteImage($path)
    {
        if (unlink(dirname(__DIR__) . '/' . $path)) { // full url to image
            // delete successfully
        } else {
            echo "you have an error deleting image of your product";
        }
    }

    public function save($id = '', $name, $price, $oldImage = '')
    {
        $helper = new Helper();
        // image links if use is creating new product / update , gotten from updateForm
        $newImage = $this->uploadFile();

        if (empty($id)) // $id empty -> creating new product, otherwise -> update
        {
            if (empty($name) || empty($price) || empty($newImage)) {   // if any of fields is emty - > go back to create new product page
                if (!headers_sent()) {
                    header("location:" . $helper->getURL() . "HornyMVC/admin/form/createnew");
                    exit();
                }
            } else {
                $this->createNewRecord($newImage, $name, $price);
                // after created , show all

                if (!headers_sent()) {
                    header("location:" . $helper->getURL() .  "HornyMVC/admin/list.html");
                    exit();
                }
            }
        } else {  // update product , and no new image has been uploaded
            if (empty($name) || empty($price)) {
                if (!headers_sent()) {

                    header("location:" . $helper->getURL() .  "HornyMVC/admin/form/update/$id");
                    exit();
                }
            } else {
                if (empty($newImage)) // if use does not update any img when editing product
                {
                    $this->updateOneRecord($id, $oldImage, $name, $price);
                } else {
                    // delete old oldImage if user uploaded new image
                    $this->deleteImage($oldImage);
                    $this->updateOneRecord($id, $newImage, $name, $price);
                }
                // after all , show list
                if (!headers_sent()) {
                    header("location:" . $helper->getURL() .  "HornyMVC/admin/list.html");
                    exit();
                }
            }
        }
    }


    public function deleteOneRecord($id)
    {

        $this->deleteImage($this->getOneRecord($id)['image']);
        $this->deleteRecord($id);
        // after delete, show all products 
        $helper = new Helper();
        if (!headers_sent()) {
            header("location: " . $helper->getURL() .  "HornyMVC/admin/list.html");
            exit();
        }
        // include_once 'views/viewall.php';
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
                        $destinationFolder = 'upload/' . $fileNameNew;

                        // uploadfile 
                        move_uploaded_file($fileTmpName, dirname(__DIR__) . '/' .  $destinationFolder);
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
