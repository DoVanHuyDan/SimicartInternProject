<?php

include_once(dirname(__DIR__) . '/model/dbinteractions.php');
  $limit = $_POST['limit'];
   
  if( empty( $limit ) )
  {
     // show something here 
  }
  else
  {  
     
     $conn = new DbInteractions();
     $data  = $conn->getNRecord($limit);
     if( empty($data) )
     {
         echo '<p>there is no data to show!</p>';
     }
     else
     {   
         include_once(dirname(__DIR__) . '/views/read.php');
     }
  }
?>