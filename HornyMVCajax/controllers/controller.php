<?php

include_once(dirname(__DIR__) . "/models/dbinteractions.php");
include_once(dirname(__DIR__) . "/helper.php");
include_once(__DIR__ . '/delete.php');
include_once(__DIR__ . '/detail.php');
include_once(__DIR__ . '/update.php');
include_once(__DIR__ . '/viewall.php');

class Controller extends DbInteractions
{


    public function handleRequests($data)
    {
        $op = $data['op'];
        switch ($op) {
            
            case 'showAll':
                $viewAll = new ViewAll();
                $viewAll->showAll();
                break;

            case 'showDetail':
                $detail = new Detail();
                $detail->showDetail($data['id']);
                break;

            case 'createnew':
                $update = new Update();
                $update->showUpdateForm();
                break;

            case 'update':
                $update = new Update();
                $update->showUpdateForm($data['id']);
                break;
            case 'delete':
                $delete = new Delete();
                $delete->deleteOneRecord($data['id']);
                break;

            case 'updateChange':
                $update = new Update();
               
                $update->save($data['id'], $data['name'], $data['price'], isset( $data['oldImage']) ?  $data['oldImage'] : '' , $_FILES);
                break;
        }
    }
}


// controller.php is called by post only when using ajax 
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $controller = new Controller();
    $data = json_decode($_POST['data'],true);  
    $controller->handleRequests($data);
}





