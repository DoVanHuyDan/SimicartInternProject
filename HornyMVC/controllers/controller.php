<?php

include_once( dirname(__DIR__) . "/models/dbinteractions.php" );
include_once( dirname(__DIR__) . "/helper.php" );

class Controller extends DbInteractions
{   
    

    public function pageNotFound()
    {
        include_once( dirname(__DIR__) . "/views/404-notfound-page.html" );
    }

    public function showAll()
    {
        include_once( dirname(__DIR__) . "/views/viewall.php" );

    }

    public function showDetail($id)
    {
        include_once( dirname(__DIR__) . "/views/detail.php" );

    }

    public function showUpdateForm($id = null)
    {
        include_once( dirname(__DIR__) . "/views/update.php" );
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
        include_once( dirname(__DIR__) . "/views/viewall.php" );

    }

    public function deleteOneRecord($id)
    {
        
        $this->deleteImage($this->getOneRecord($id)['image']);
        $this->deleteRecord($id);
        // after delete, show all products 
        $helper = new Helper();
        header("location: " . $helper->getURL() .  "HornyMVC/admin/list.html");
       // include_once 'views/viewall.php';
    }

    public function saveNew($name, $price,$file)
    {    // assign $image  = path to the uploaed image
        $image = $this->uploadFile();

        if (empty($name) || empty($price) || empty($image)) {
            

            header('location: createnew');
            
        } else {


            $this->createNewRecord($image, $name, $price);

          
            // after created , show all

            $helper = new Helper();

           
            header("location:" . $helper->getURL() .  "HornyMVC/admin/list.html");

           
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



    public function handleRequests($op,$id='',$name='',$price='',$file='',$oldImage='')
    {
        switch ($op)
        {
            case '404':
                $this->pageNotFound();
            break;

            case 'showAll':
                $this->showAll();
            break;

            case 'showDetail' :
                $this->showDetail($id);
            break;

            case 'createnew':
                $this->showUpdateForm();
            break;

            case 'update':
                $this->showUpdateForm($id);
            break;

            case 'save':
                $this->saveNew($name,$price,$file);
            break;

            case 'delete':
                $this->deleteOneRecord($id);
            break;

            case 'updateChange':
                $this->update($id, $name,$price,$oldImage);
            break;
        }
    }
}
