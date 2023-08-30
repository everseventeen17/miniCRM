<?php
require_once 'app/models/pages/PageModel.php';

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
            $errors = [];
            foreach ($pages as $page) {
                if ($page['page_url'] === $pageName) {
                    $errors[] = 'Такая страница уже существует!';
                }
            }
            if (strlen($pageName) <= 0) {
                $errors[] = 'Имя страницы обязательно!';
            }
            if (strlen($pageUrl) <= 0) {
                $errors[] = 'Ссылка на страницу обязательна!';
            }

            if (count($errors) !== 0) {
                echo "<pre>";
                print_r($errors);
                echo "</pre>";
                return;
            } else {
                echo 'ok';
                $pageModel->createPage($pageName, $pageUrl);
            }
        }
    }

    public function delete()
    {
        $pageModel = new PageModel();
        if ($pageModel->deletePage($_GET['id'])) {
            echo 1;
            return;
        } else {
            echo 0;
            return;
        }
    }

    public function edit()
    {
        $pageModel = new PageModel();
        $page = $pageModel->getPageById($_GET['id']);
        if (!$page) {
            echo "Page not fount";
            return;
        }
        include './app/views/pages/edit.php';
    }

    public function update()
    {
        $pageModel = new PageModel();
        if (isset($_POST['page_name']) and isset($_POST['page_url']) and isset($_POST['id'])) {
            $pageName = trim($_POST['page_name']);
            $pageUrl = trim($_POST['page_url']);
            $id = $_POST['id'];
            $errors = [];
            if (empty($pageName)) {
                $errors[] = "Page name is required";
            }
            if (empty($pageUrl)) {
                $errors[] = "Page url is required";
            }
            if (empty($id)) {
                $errors[] = "You may choose page";
            }
            if (count($errors) !== 0) {
                echo "<pre>";
                print_r($errors);
                echo "</pre>";
                return;
            } else {
                echo 'ok';
                $role = $pageModel->updatePage($pageName, $pageUrl, $id);
            }
        }
    }
}