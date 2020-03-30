<?php

class Dhb
{
    private $hostName = 'localhost';
    private $userName = 'dan';
    private $passWord = '100399';
    private $databaseName = 'crud';

    protected function connectionPDO()
    {   
     

        $conn = new PDO("mysql:host=$this->hostName;dbname=$this->databaseName", $this->userName, $this->passWord);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        echo "Connected successfully"; 
        return $conn;
    
    }

    // Using mysqli

    protected function connectionMSQLI()
    {
        $conn = new mysqli($this->hostName, $this->userName,$this->passWord,$this->databaseName);

        return $conn;
    }


}


?>