<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Css style sheet -->
    <link rel="stylesheet" href="../phpCRUD/Styles/css.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 

</head>
<body>
<?php

include_once 'classes/controler.class.php';
include_once 'classes/view.class.php';

// get data from form
if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
   
    $name = testInput( $_POST['name'] );
    $location = testInput( $_POST['location'] );

    $ctr = new Controler();
    if( isset($_POST['save']) ) // if click on save
    {
        $ctr->createData($name, $location);
      
 }

    if( isset($_POST['update']) )  // if click on update
    {   
        $id = (int)$_POST['update']; // get $id from value attribute of button (update) from index.php if it has been clicked
        $ctr->updateRow($id, $name, $location); 
        
    }
    
}

// delete date
if( isset($_GET['delete']) )
{   
    $id = $_GET['delete'];
    $delete = new Controler();
    $delete->removeData($id);
}

$view = new View();
$view->showData();






// optimize data
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
</body>
</html>