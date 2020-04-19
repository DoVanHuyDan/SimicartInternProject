<?php

    if( isset($_POST['id']) )
    { 

        include_once(dirname(__DIR__) . "/model/dbinteractions.php");

        $id = $_POST['id'];
        $dbinteraction = new DbInteractions();
    
        $record = $dbinteraction->getOneRecord($id);
        
        include_once(dirname(__DIR__) . '/views/read_once.php');
    
    }
    else
    {
        echo 'id is not set yet';
    }
?>