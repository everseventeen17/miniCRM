<?php

namespace controllers\pages;
use models\pages\PageModel;


class PageController
{
    public function index()
    {
        $pageModel = new PageModel();
        $pages = $pageModel->getAllPages();
        include './app/views/pages/index.php';
    }

    public function create()
    {
        include './app/views/pages/create.php';
    }

    public function store()
    {
        $pageModel = new PageModel();
        $pages = $pageModel->getAllPages();
        if (isset($_POST['page_name']) and isset($_POST['page_url'])) {
            $pageName = trim($_POST['page_name']);
            $pageUrl = trim($_POST['page_url']);
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
                $pageModel->createPage($pageName, $pageUrl);
            }
        }
    }

    public function delete()
    {
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
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $pageModel = new PageModel();
        $page = $pageModel->getPageById($url[3]);
        if (!$page) {
            echo "Page not found";
            return;
        }else{
            include './app/views/pages/edit.php';
        }
    }

    public function update()
    {
        $pageModel = new PageModel();
        if (isset($_POST['page_name']) and isset($_POST['page_url']) and isset($_POST['id'])) {
            $pageName = trim($_POST['page_name']);
            $pageUrl = trim($_POST['page_url']);
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
                $role = $pageModel->updatePage($pageName, $pageUrl, $id);
            }
        }
    }
}