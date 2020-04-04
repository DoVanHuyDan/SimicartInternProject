<?php

include_once 'models/dbinteractions.php';

class Controller extends DbInteractions
{

    public function showAll()
    {
        include_once 'views/viewall.php';
    }

    public function showDetail($id)
    {
        include_once 'views/detail.php';
    }

    public function showUpdateForm($id = null)
    {

        include_once 'views/update.php';
    }

    public function deleteImage($path)
    {
        if (unlink($path)) {
            // delete successfully
        } else {
            echo "you have an error deleting image of your product";
        }
    }

    public function update($id, $name, $price, $oldImage)
    {

        $newImage = $this->uploadFile();
        if ( !empty($name) )  {
            if (empty($newImage)) // if user did upload any new image when updating 
            {
                $this->updateOneRecord($id, $oldImage, $name, $price);
            } else {
                // delete old oldImage if user uploaded new image
                $this->deleteImage($oldImage);
                $this->updateOneRecord($id, $newImage, $name, $price);
            }
            echo '
                <div class="alert alert-primary" role="alert">
                Updated!
                </div>           
                ';
        } else {
            echo '
                
                <div class="alert alert-danger" role="alert">
                 you need to fill up all fields!
                </div>
                
                ';
        }

        // after update, show all products 
        include_once 'views/viewall.php';
    }

    public function deleteOneRecord($id)
    {
        
        $this->deleteImage($this->getOneRecord($id)['image']);
        $this->deleteRecord($id);
        // after delete, show all products 
        header("location: index.php");
       // include_once 'views/viewall.php';
    }

    public function createNew($name, $price)
    {    // assign $image  = path to the uploaed image
        $image = $this->uploadFile();

        if (empty($name) || empty($price) || empty($image)) {
            echo '
                
                <div class="alert alert-danger" role="alert">
                 you need to fill up all fields!
                </div>
                
                ';
            include_once 'views/update.php';
        } else {


            $this->createNewRecord($image, $name, $price);

            echo '

                <div class="alert alert-primary" role="alert">
                Created and saved!
                </div>
                
                ';
            // after created , show all
            include_once 'views/viewall.php';
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
                        $destinationFolder = 'upload/' . $fileNameNew;

                        // uploadfile 
                        move_uploaded_file($fileTmpName, $destinationFolder);
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

    // method to handle requests sent by GET
    public function handleRequests()
    {

        // if user click on any links / button on viewall page , means that param has been sent here by GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            $op = isset($_GET['op']) ? $_GET['op'] : null;

            try {



                if (!$op || $op == "showall") {
                    $this->showAll();
                } elseif ($op == "showDetail") {
                    $this->showDetail($_GET['id']);
                } elseif ($op == "delete") {
                    $this->deleteOneRecord($_GET['id']);
                } elseif ($op == "showUpdateForm") {
                    $this->showUpdateForm($_GET['id']);
                } elseif ($op == "createnew") {
                    $this->showUpdateForm();
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

            // op just will be sent by POST when user updates data for a product / create  new one
            $op = isset($_GET['op']) ? $_GET['op'] : null;

            if ($op == "update") {

                $this->update($_GET['id'], $_POST['name'], $_POST['price'], $_POST['oldImage']);
            } elseif ($op == "createnew") {
                $this->createNew($_POST['name'], $_POST['price']);
            }
        }
    }
}
