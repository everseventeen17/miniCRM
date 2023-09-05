<?php

namespace controllers\todo\category;

use models\todo\category\CategoryModel;
use models\Check;

class CategoryController
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
        $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategories();
        include './app/views/todo/category/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        include './app/views/todo/category/create.php';
    }

    public function store()
    {

        $this->check->requirePermission();
        if (isset($_POST['title']) and isset($_POST['description'])) {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
            $errors = [0 => [], 1 => []];
            if (strlen($title) <= 0) {
                $errors[0]['title'] = 'Название обязательно!';
            }
            if (strlen($description) <= 0) {
                $errors[1]['description'] = 'Описание обязательно!';
            }
            if (!empty($errors[0]) or !empty($errors[1])) {
                print_r(json_encode($errors));
            } else {
                print_r(json_encode('ok'));
                $todoCategoryModel = new CategoryModel();
                $todoCategoryModel->createTodoCategory($title, $description, $user_id);
            }
        }
    }

    public function delete()
    {
        $this->check->requirePermission();
        $todoCategoryModel = new CategoryModel();
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        if ($todoCategoryModel->deleteTodoCategory($url[4])) {
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

        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $todoCategoryModel = new CategoryModel();
        $category = $todoCategoryModel->getTodoCategoryById($url[4]);
        if (!$category) {
            echo "category not found";
            return;
        }
        include './app/views/todo/category/edit.php';
    }

    public function update()
    {
        $this->check->requirePermission();


        if (isset($_POST['title']) and isset($_POST['description']) and isset($_POST['id'])) {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $id = $_POST['id'];
            $usability = isset($_POST['usability']) ? $_POST['usability'] : 0;
            $errors = [0 => [], 1 => []];
            if (empty($title)) {
                $errors[0]['title'] = 'Введите название';
            }
            if (empty($description)) {
                $errors[1]['description'] = 'Введите описание!';
            }
            if (empty($id)) {
                $errors[1]['title'] = 'Выберете todoList task';
            }
            if (!empty($errors[0]) or !empty($errors[1])) {
                print_r(json_encode($errors));
                return;
            } else {
                print_r(json_encode('ok'));
                $todoCategoryModel = new CategoryModel();
                $category = $todoCategoryModel->updateTodoCategory($title, $description, $usability, $id);
            }
        }
    }
}