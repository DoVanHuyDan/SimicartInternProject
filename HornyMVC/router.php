<?php
include_once 'controllers/controller.php';
class Router

{
    public $controller = '';
    public $op = '';
    public function parseURL()
    {
        // get url from link / see .htaccess for more details about where url comes from
        $url = $_GET['url']; // localhost/HornyMVC/admin/erfds/sd/ds  -> $url = admin/erfds/sd/ds 
        $url = explode('/', trim($url));

        return $url;
    }

    public function routing()
    {


        $this->controller = new Controller();
        $url = $this->parseURL();


        // var_dump($url);

        if ($url[0] == 'admin') {
            if (!empty($url[1])) {
                switch ($url[1]) {
                    case 'list.html':
                        if (!empty($url[2]) && $url[2] == 'delete') {
                            // delete item 
                        // admin/list.html/delte/id

                            $this->op = 'delete';
                            $this->controller->handleRequests($this->op,$url['3']);
                        break;

                        } else {
                            $this->op = 'showAll';
                            $this->controller->handleRequests($this->op);
                            break;
                        }

                    case 'detail': // admin/detail/1  $url[2] =  1  / id of product to show detail
                        if (!empty($url[2])) {
                            $this->op = 'showDetail';
                            $this->controller->handleRequests($this->op, $url[2]);
                        } else {

                            // show 404
                            $this->op = '404';
                            $this->controller->handleRequests($this->op);
                        }

                        break;
                    case 'form': // admin/form/createnew or admin/form/update/id  --> $url[2] = creatnew / update
                        if (!empty($url[2])) {
                            switch ($url[2]) {
                                case 'createnew':
                                    $this->op = 'createnew';
                                    $this->controller->handleRequests($this->op);
                                    break;

                                case 'update':
                                    if (!empty($url[3])) {
                                        $this->op = 'update';           // $url[3] is id of product for update
                                        $this->controller->handleRequests($this->op, $url[3]);
                                    } else {
                                        // show 404
                                        $this->op = '404';
                                        $this->controller->handleRequests($this->op);
                                    }
                                    break;

                                case 'save': // save after creating anew product
                                    $this->op = 'save';
                                    // $_GET['name'] , $_GET['price'] come from Update.php when user create a new product
                                  
                                    $this->controller->handleRequests($this->op,'', $_POST['name'], $_POST['price'], $_FILES);
                                break;

                                case 'updateChange': // http://localhost/HornyMVC/admin/form/saveChange/id
                                    $this->op = 'updateChange';
                                    $this->controller->handleRequests($this->op, $url[3] , $_POST['name'] ,$_POST['price'], $_FILES,$_POST['oldImage']);
                                break;
                                }
                        } else {
                            // show 404
                            $this->op = '404';
                            $this->controller->handleRequests($this->op);
                        }
                }
            } else {
                // show 404
                $this->op = '404';
                $this->controller->handleRequests($this->op);
            }
        } else {
            // show 404
            $this->op = '404';
            $this->controller->handleRequests($this->op);
        }
    }
}

$router = new Router();
$router->routing();
