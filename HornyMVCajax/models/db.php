<?php

class Db
{
    private $hostName = 'localhost';
    private $userName = 'dan';
    private $passWord = '100399';
    private $databaseName = 'horny';   
    

    protected function connectionPDO()
    {   
     

        try {
            $conn = new PDO("mysql:host=$this->hostName;dbname=$this->databaseName", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       //     echo "Connected successfully";
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
    
    }

    // Using mysqli

    protected function connectionMSQLI()
    {
        $conn = new mysqli($this->hostName, $this->userName,$this->passWord,$this->databaseName) or die();

        return $conn;
    }
}
