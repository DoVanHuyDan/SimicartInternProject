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

$name = '';
$location = '';
$update = false;
$id = '';
  // edit date
if( isset($_GET['edit']) )
{
    $id = $_GET['edit'];
    $getRow = new Controler();
    $row = $getRow->getRow($id);
    
    $name = $row[0];
    $location = $row[1];
    $update = true;
}

?>
 
  <div class="container-fluid">
  <form id="form" method="POST" action="../phpCRUD/process.php">
  <div class="form-group">
    <label for="Name">Name</label><span>*</span>
    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="Name" aria-describedby="emailHelp" placeholder="Name">
    <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="location">Location</label><span>*</span>
    <input type="text" name="location" value="<?php echo $location; ?>" class="form-control" id="Location" placeholder="Location">
  </div>
  <?php
  // if edit button has been clicked -> $update = true
    if( $update )
    {
      // pass $id of row to update 
      echo '<button type="submit" name="update" value="' . $id . '" class="btn btn-primary">Update</button>';
    }
    else{
      echo ' <button type="submit" name="save" class="btn btn-primary">Save</button>';
    }
  ?>
 
</form>
  </div>
  
</body>
</html>