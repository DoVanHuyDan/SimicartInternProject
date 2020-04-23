<?php

// handle request from AJAX
include_once(__DIR__ . '/delete.php');
include_once(__DIR__ . '/detail.php');
include_once(__DIR__ . '/update.php');
include_once(__DIR__ . '/viewall.php');

$delete = new Delete();
$detail = new Detail();
$update = new Update();
$viewAll = new ViewAll();


if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'detail':
            $detail->showDetail($_POST['id']);
            break;
        case 'delete':
            $delete->deleteOneRecord($_POST['id']);
            break;
        case 'edit':
            $update->showUpdateForm($_POST['id']);
            break;
        case 'createnew':
            $update->showUpdateForm();
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

                $update->save($id, $name, $price, $oldImage);
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
