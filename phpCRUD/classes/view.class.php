<?php

   include_once 'view.class.php';

    class View extends Model
    {
        public function showData()
        {   
            $allData =  $this->getData();
            
            echo '<div class="container-fluid">
            <table class="table table-striped">
            <thead class="thead-dark">
              <tr>

                <th scope="col">Name</th>
                <th scope="col">Location</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>';


           if( $allData ) // if $allData has been returned null -> show nothing
           {
            foreach($allData as $row)
            {
                echo '
              <tr>
                <td>' . $row['name'] . '</td>
                <td>'. $row['location'] .'</td>
                <td>
                <a href="index.php?edit='. $row['id'] .'" class="btn btn-info">Edit</a>
                <a href="process.php?delete='. $row['id'] .'" class="btn btn-danger">Delete</a>
                </td>
              </tr>';
            }
           }
            
            echo '
            </tbody>
            </table>
            </div>';

            echo ' <a id="add" href="index.php"><button type="button" class="btn btn-primary">Add</button></a>';
           

        }
    }

?>