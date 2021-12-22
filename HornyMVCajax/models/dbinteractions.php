<?php
require_once(__DIR__ . "/db.php");


class DbInteractions extends Db
{

    // get all data from database
    public function getAllRecords()
    {
        $conn = $this->connectionMSQLI();
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) return $result->fetch_all(MYSQLI_ASSOC);
        return null;
    }

    // get 1 record

    public function getOneRecord($id)
    {
        $conn = $this->connectionMSQLI();
        $sql = "SELECT * FROM products where id = $id;";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    // update on record
    public function updateOneRecord($id, $image, $name, $price)
    {
        $conn = $this->connectionMSQLI();
        $stmt = $conn->prepare("UPDATE products SET image=?, name=?, price=? WHERE id=?;");
        $stmt->bind_param("ssii", $image, $name, $price, $id);
        $stmt->execute() or die($stmt->error);
        $conn->close();
    }

    public function deleteRecord($id)
    {
        $conn = $this->connectionMSQLI();
        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute() or die($stmt->error);
        $conn->close();
    }

    public function createNewRecord($image, $name, $price)
    {
        $conn = $this->connectionMSQLI();
        $stmt = $conn->prepare("INSERT INTO products (image, name, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $image, $name, $price);
        $stmt->execute() or die($stmt->error);
        $conn->close();
    }
}
