<?php
    include_once(dirname(__DIR__) . '/model/dbinteractions.php');

    echo '<!-- if id is set => editing product -->';
    if( isset($_POST['id']) )
    {   
        $id  = $_POST['id'];    
        $dbinteraction = new DbInteractions();
    
        $record = $dbinteraction->getOneRecord($id);
        include_once(dirname(__DIR__) . '/views/create_update.php');
    } 
    else
    {    
        echo '<!-- if id is not set => create a new product -->';
        include_once(dirname(__DIR__) . '/views/create_update.php');
    }
?>