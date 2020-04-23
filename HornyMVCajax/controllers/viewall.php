<?php

class ViewAll extends DbInteractions
{

    public function showAll()
    {
        include_once(dirname(__DIR__) . "/views/viewall.php");
    }
}
