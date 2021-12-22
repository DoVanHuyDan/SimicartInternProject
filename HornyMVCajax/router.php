<?php
include_once(__DIR__ . '/controllers/controller.php');
include_once(__DIR__ . '/helper.php');

class Router

{
    public $controller = '';
    public $op = '';
    public $helper = '';

    public function parseURL()
    {
        // get url from link / see .htaccess for more details about where url comes from
        $url = isset($_GET['url']) ? $_GET['url'] : null; // localhost/HornyMVCajax/admin/erfds/sd/ds  -> $url = admin/erfds/sd/ds

        $url = explode('/', trim($url));

        $url = array_slice($url, array_search("HornyMVCajax", $url) ? array_search("HornyMVCajax", $url) + 1 : 0);

        return $url;
    }

    public function routing()
    {
        // ALL URL
        // http://localhost/HornyMVCajax/admin/showAll
        // http://localhost/HornyMVCajax/admin/showDetail/id
        // http://localhost/HornyMVCajax/admin/delete/id
        // http://localhost/HornyMVCajax/admin/form/update/id
        // http://localhost/HornyMVCajax/admin/form/updateChange/id
        // http://localhost/HornyMVCajax/admin/form/createnew


        $this->controller = new Controller();
        $url = $this->parseURL();
        $this->helper = new Helper();


        $action0 = array("admin"); // url[0]
        $action_followedID = array("showDetail", "delete", "update", "updateChange");
        // eg : 
        // http://localhost/HornyMVCajax/admin/showDetail/id
        // http://localhost/HornyMVCajax/admin/delete/id
        // http://localhost/HornyMVCajax/admin/form/update/id
        // http://localhost/HornyMVCajax/admin/form/updateChange/id

        $action_NotFollowedID = array("form", "createnew", "showAll", "updateChange");
        // eg:
        // http://localhost/HornyMVCajax/admin/showAll
        // http://localhost/HornyMVCajax/admin/form/createnew

        $data = '';

        // if $url[0] == admin
        if (in_array($url[0], $action0)) {

            if (in_array(end($url), $action_NotFollowedID)) {
                // eg : 
                // http://localhost/HornyMVCajax/admin/showAll
                $data = array("op" => end($url));
            } elseif (is_numeric(end($url))) {
                // eg: http://localhost/HornyMVCajax/admin/delete/id
                $data = array("op" => $url[count($url) - 2], "id" => end($url));
            }
        } else {
            if (!headers_sent()) {
                header("location: " . $this->helper->getURL() . "HornyMVCajax/admin/showAll");
                exit();
            }
        }

        // merge data getting from form to $data 
        if (isset($_POST)) {
            $data = array_merge($data, $_POST);
        }

        $this->controller->handleRequests($data);
    }
}
