<?php

namespace controllers\pages;

use models\Check;
use models\pages\PageModel;
use models\roles\RoleModel;


class PageController
{
    private $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }

    public function index()
    {
        $this->check->requirePermission();
        $pageModel = new PageModel();
        $pages = $pageModel->getAllPages();
        include './app/views/pages/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        $pageModel = new RoleModel();
        $roles = $pageModel->getAllRoles();
        include './app/views/pages/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
        $pageModel = new PageModel();
        $pages = $pageModel->getAllPages();
        if (isset($_POST['page_name']) and isset($_POST['page_url']) and isset($_POST['roles'])) {
            $pageName = trim($_POST['page_name']);
            $pageUrl = trim($_POST['page_url']);
            $roles = implode(",", $_POST['roles']);
            $errors = [0 => [], 1 => []];
            foreach ($pages as $page) {
                if ($page['page_name'] === $pageName) {
                    $errors[0]['page_name'] = 'Такая страница уже существует!';
                }
                if ($page['page_url'] === $pageUrl) {
                    $errors[1]['page_url'] = 'Такой url уже существует!';
                }
            }
            if (strlen($pageName) <= 0) {
                $errors[0]['page_name'] = 'Имя страницы обязательно!';
            }
            if (strlen($pageUrl) <= 0) {
                $errors[1]['page_url'] = 'Ссылка на страницу обязательна!';
            }

            if (!empty($errors[0]) or !empty($errors[1])) {
                print_r(json_encode($errors));
            } else {
                print_r(json_encode('ok'));
                $pageModel->createPage($pageName, $pageUrl, $roles);
            }
        }
    }

    public function delete()
    {
        $this->check->requirePermission();
        $pageModel = new PageModel();
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        if ($pageModel->deletePage($url[3])) {
            echo 1;
            return;
        } else {
            echo 0;
            return;
        }
    }

    public function edit()
    {
        $this->check->requirePermission();
        $pageModel = new RoleModel();
        $roles = $pageModel->getAllRoles();
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $pageModel = new PageModel();
        $page = $pageModel->getPageById($url[3]);
        $rolesArray = explode(',', $page['role']);
        if (!$page) {
            echo "Page not found";
            return;
        } else {
            include './app/views/pages/edit.php';
        }
    }

    public function update()
    {
        $this->check->requirePermission();
        if(isset($_POST['roles'])){
            $newRole = $_POST['roles'];
            if($this->check->isCurrentUserRole($newRole)){
                header("Location: /auth/logout");
                exit();
            }
        }
        $pageModel = new PageModel();
        if (isset($_POST['page_name']) and isset($_POST['page_url']) and isset($_POST['roles']) and isset($_POST['id'])) {
            $pageName = trim($_POST['page_name']);
            $pageUrl = trim($_POST['page_url']);
            $roles = implode(",", $_POST['roles']);
            $id = $_POST['id'];
            $errors = [0 => [], 1 => []];
            if (empty($pageName)) {
                $errors[0]['page_name'] = 'Название роли обязательно';
            }
            if (empty($pageUrl)) {
                $errors[1]['page_url'] = 'Url старницы обязательно!';
            }
            if (empty($id)) {
                $errors[0]['page_name'] = 'Выберете страницу!';
            }
            if (!empty($errors[0]) or !empty($errors[1])) {
                print_r(json_encode($errors));
                return;
            } else {
                print_r(json_encode('ok'));
                $role = $pageModel->updatePage($pageName, $pageUrl, $roles, $id);
            }
        }
    }
}