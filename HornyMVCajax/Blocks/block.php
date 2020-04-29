<?php

require_once(dirname(__DIR__) . '/models/dbinteractions.php');

class Block
{
    public function getAllRecords()
    {
        $dbinteration = new DbInteractions();
        return $dbinteration->getAllRecords();
    }

    public function getOneRecord($id)
    {
        $dbinteration = new DbInteractions();
        return $dbinteration->getOneRecord($id);
    }

}

?>