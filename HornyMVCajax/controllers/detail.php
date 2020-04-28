<?php
include_once(dirname(__DIR__) . "/models/dbinteractions.php");


class Detail extends DbInteractions
{

    public function showDetail($id)
    {
        include_once(dirname(__DIR__) . "/views/detail.php");
    }
}
