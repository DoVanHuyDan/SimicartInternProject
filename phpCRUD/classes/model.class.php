



<?php

    include_once 'dbh.class.php';

    class Model extends Dhb
    {
        protected function setData($name, $location)
        {   
            $conn = $this->connectionMSQLI();
            $stmt = $conn->prepare("INSERT INTO data (name, location) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $location);
            $stmt->execute() or die($stmt->error);
            $conn->close();
        }

        protected function getData()
        {
            $conn = $this->connectionMSQLI();
            $sql = "SELECT * FROM data";
            $result = $conn->query($sql) or die($result->error);

            if( $result->num_rows > 0 ) return $result->fetch_all(MYSQLI_ASSOC);
            return null;
        }

        protected function deleteData($id)
        {
            $conn = $this->connectionMSQLI();
            $stmt = $conn->prepare("DELETE FROM data WHERE id=?");
            $stmt->bind_param("i",$id);
            $stmt->execute() or die($stmt->error);
            $conn->close();
        }

        protected function selectRow($id)
        {
            $conn = $this->connectionMSQLI();
            $sql = "SELECT * FROM data WHERE id=$id";
            $result = $conn->query($sql) or die($result->error);
            return $result->fetch_row();
        }

        protected function updateData($id, $name, $location)
        {
            $conn = $this->connectionMSQLI();
            $stmt = $conn->prepare("UPDATE data SET name=?, location=? WHERE id=?;");
            $stmt->bind_param("ssi",$name, $location, $id);
            $stmt->execute() or die($stmt->error);
            $conn->close();
        }
    }


?>