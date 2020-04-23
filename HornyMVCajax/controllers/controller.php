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

            case 'save':
                $update = new Update();
                $update->save('', $data['name'], $data['price'], '');
                break;

            case 'delete':
                $delete = new Delete();
                $delete->deleteOneRecord($data['id']);
                break;

            case 'updateChange':
                $update = new Update();
                $update->save($data['id'], $data['name'], $data['price'], $data['oldImage']);
                break;
        }
    }
}



