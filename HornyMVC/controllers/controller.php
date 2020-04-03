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

    public function showUpdateForm($id)
    {
        include_once 'views/update.php';
    }

    public function update($id, $name, $price, $image)
    {
        $this->updateOneRecord($id, $image, $name, $price);
        echo '
            <div class="alert alert-primary" role="alert">
            Updated!
            </div>
            
            ';
        // after update, show all products 
        include_once 'views/viewall.php';
    }

    public function deleteOneRecord($id)
    {
        $this->deleteRecord($id);
        // after delete, show all products 
        include_once 'views/viewall.php';
    }

    public function createNew($name, $price, $image)
    {

        if (empty($name) || empty($price) || empty($image)) {
            echo '
                
                <div class="alert alert-danger" role="alert">
                 you need to fill up all fields!
                </div>
                
                ';
            include_once 'views/createnew.php';
        }
        else{
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
    // method to handle requests sent by GET
    public function handleRequests()
    {
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
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {

            // op just will be sent by POST when user updates data for a product
            $op = isset($_GET['op']) ? $_GET['op'] : null;

            if ($op == "update") {
                $this->update($_GET['id'], $_POST['name'], $_POST['price'], $_POST['image']);
            } elseif ($op == "createnew") {
                $this->createNew($_POST['name'], $_POST['price'], $_POST['image']);
            }
        }
    }
}
