<?php

class Router
{
    public function run()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        switch ($page) {
            case '' :
            case 'home' :
                $controller = new \controllers\HomeController();
                $controller->index();
                break;
            case 'users':
                $controller = new UserController();
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'create':
                            $controller->create();
                            break;
                        case 'store':
                            $controller->store();
                            break;
                        case 'delete':
                            $controller->delete();
                            break;
                        case 'edit':
                            $controller->edit();
                            break;
                        case 'update':
                            $controller->update();
                            break;
                    }
                } else {
                    $controller->index();
                }
                break;
            case 'register':
                $controller = new AuthController();
                $controller->register();
                break;
            case 'login':
                $controller = new AuthController();
                $controller->login();
                break;
            case 'logout':
                $controller = new AuthController();
                $controller->logout();
                break;
            case 'signup':
                $controller = new AuthController();
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'store':
                            $controller->store();
                            break;
                    }
                } else {
                    $controller->login();
                }
                break;
            case 'signin':
                $controller = new AuthController();
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'auth':
                            $controller->auth();
                            break;
                    }
                } else {
                    $controller->login();
                }
                break;
            default:
                http_response_code(404);
                echo 'Page not found';
                break;
        }

    }

}