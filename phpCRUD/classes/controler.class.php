<?php

    include_once 'model.class.php';

    class Controler extends Model
    {
        public function createData($name, $location)
        {
            $this->setData($name, $location);
        }

        public function removeData($id)
        {
            $this->deleteData($id);
        }

        public function getRow(&$id)
        {
            return $this->selectRow($id);
        }
    }
?>
