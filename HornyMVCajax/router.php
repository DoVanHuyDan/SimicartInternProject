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
        $url = isset($_GET['url']) ? $_GET['url'] : null; // localhost/HornyMVC/admin/erfds/sd/ds  -> $url = admin/erfds/sd/ds

        $url = explode('/', trim($url));

        $url = array_slice($url, array_search("HornyMVC", $url) ? array_search("HornyMVC", $url) + 1 : 0);

        return $url;
    }

    public function routing()
    {



        $this->controller = new Controller();
        $url = $this->parseURL();
        $this->helper = new Helper();



        if ($url[0] == 'admin') {
            // admin/A/B/C  -> $url[0] == admin
            if (!empty($url[1])) {
                switch ($url[1]) {
                    case 'list.html': // admin/list.html / A / B 
                        if (!empty($url[2]) && $url[2] == 'delete' && is_numeric(($url[3]))) {
                            // delete item 
                            // admin/list.html/delte/id

                            $data = array("op" => "delete", "id" => $url[3]);
                            $this->controller->handleRequests($data);
                        } else {

                            // Show all
                            // admin/list.html
                            $data = array("op" => "showAll");
                            $this->controller->handleRequests($data);
                        }
                        break;

                    case 'detail': // admin/detail/1  $url[2] =  1  / id of product to show detail
                        if (!empty($url[2])) {
                            $data = array("op" => "showDetail", "id" => $url[2]);
                            $this->controller->handleRequests($data);
                        } else {
                            // admin/detail  -> do not know what item to show - > show all
                            $data = array("op" => "showAll");
                            $this->controller->handleRequests($data);
                        }

                        break;
                    case 'form': // admin/form/createnew or admin/form/update/id  --> $url[2] = creatnew / update
                        if (!empty($url[2])) {
                            switch ($url[2]) {
                                case 'createnew':
                                    // admin/form/createnew 
                                    $data = array("op" => "createnew");
                                    $this->controller->handleRequests($data);
                                    break;

                                case 'update':
                                    // admin/form/update/id
                                    if (!empty($url[3])) {
                                        $data = array("op" => "update", "id" => $url[3]);          // $url[3] is id of product for update
                                        $this->controller->handleRequests($data);
                                    } else {
                                        // admin/form/update do not know what item to update -> show all
                                        $data = array("op" => "showAll");
                                        $this->controller->handleRequests($data);
                                    }
                                    break;

                                case 'save': // save after creating anew product admin/form/save
                                    // $_POST['name'] , $_POST['price'], $_FILES come from Update.php when user create a new product
                                    $data = array("op" => "save", "name" => $_POST['name'], "price" => $_POST['price'], "file" => $_FILES);
                                    $this->controller->handleRequests($data);
                                    break;

                                case 'updateChange': // http://localhost/HornyMVC/admin/form/saveChange/id
                                    $this->op = 'updateChange';
                                    $data = array("op" => "updateChange", "id" => $url[3], "name" => $_POST['name'], "price" => $_POST['price'], "file" => $_FILES, "oldImage" => $_POST['oldImage']);
                                    $this->controller->handleRequests($data);
                                    break;
                                default:
                                    break;
                            }
                        } else {
                            // if page not found - > show all 
                            $data = array("op" => "showAll");
                            $this->controller->handleRequests($data);
                        }

                        break;
                    default:
                        if (!headers_sent()) {
                            header("location: " . $this->helper->getURL() . "HornyMVC/admin/list.html");
                            exit();
                        }
                        break;
                }
            } else {
                // if page not found - > show all 
                if (!headers_sent()) {
                    header("location: " . $this->helper->getURL() . "HornyMVC/admin/list.html");
                    exit();
                }
            }
        } else {
            // if page not found - > show all 
            if (!headers_sent()) {
                header("location: " . $this->helper->getURL() . "HornyMVC/admin/list.html");
                exit();
            }
        }
    }
}
