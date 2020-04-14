<?php
include_once(__DIR__ . '/controllers/controller.php');
include_once(__DIR__ . '/helper.php');

class Router

{
    public $controller = '';
    public $op = '';
    public $helper ='';

    public function parseURL()
    {
        // get url from link / see .htaccess for more details about where url comes from
        $url = $_GET['url']; // localhost/HornyMVC/admin/erfds/sd/ds  -> $url = admin/erfds/sd/ds

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

                            $this->op = 'delete';
                            $this->controller->handleRequests($this->op, $url['3']);
                        } else {

                            // Show all
                            // admin/list.html

                            $this->op = 'showAll';
                            $this->controller->handleRequests($this->op);
                        }
                        break;

                    case 'detail': // admin/detail/1  $url[2] =  1  / id of product to show detail
                        if (!empty($url[2])) {
                            $this->op = 'showDetail';
                            $this->controller->handleRequests($this->op, $url[2]);
                        } else {
                            // admin/detail  -> do not know what item to show - > show all
                            $this->op = 'showAll';
                            $this->controller->handleRequests($this->op);
                        }

                        break;
                    case 'form': // admin/form/createnew or admin/form/update/id  --> $url[2] = creatnew / update
                        if (!empty($url[2])) {
                            switch ($url[2]) {
                                case 'createnew':
                                    // admin/form/createnew 
                                    $this->op = 'createnew';
                                    $this->controller->handleRequests($this->op);
                                    break;

                                case 'update':
                                    // admin/form/update/id
                                    if (!empty($url[3])) {
                                        $this->op = 'update';           // $url[3] is id of product for update
                                        $this->controller->handleRequests($this->op, $url[3]);
                                    } else {
                                        // admin/form/update do not know what item to update -> show all
                                        $this->op = 'showAll';
                                        $this->controller->handleRequests($this->op);
                                    }
                                    break;

                                case 'save': // save after creating anew product admin/form/save
                                    $this->op = 'save';
                                    // $_GET['name'] , $_GET['price'] come from Update.php when user create a new product

                                    $this->controller->handleRequests($this->op, '', $_POST['name'], $_POST['price'], $_FILES);
                                    break;

                                case 'updateChange': // http://localhost/HornyMVC/admin/form/saveChange/id
                                    $this->op = 'updateChange';
                                    $this->controller->handleRequests($this->op, $url[3], $_POST['name'], $_POST['price'], $_FILES, $_POST['oldImage']);
                                    break;
                                default:
                                    break;
                            }
                        } else {
                            // if page not found - > show all 
                            $this->op = 'showAll';
                            $this->controller->handleRequests($this->op);
                        }

                        break;
                    default:
                        header("location: " . $this->helper->getURL() . "HornyMVC/admin/list.html");
                        break;
                }
            } else {
                // if page not found - > show all 
                header("location: " . $this->helper->getURL(). "HornyMVC/admin/list.html");
            }
        } else {
            // if page not found - > show all 
            header("location: " . $this->helper->getURL() . "HornyMVC/admin/list.html");
        }
    }
}



$router = new Router();
$router->routing();
