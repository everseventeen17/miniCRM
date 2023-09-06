<?php

namespace controllers\todo\tasks;

use models\todo\tasks\TaskModel;
use models\todo\category\CategoryModel;
use models\Check;

class TaskController
{
    private $check;
    private $userId;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $this->check = new Check($userRole);
        $this->userId = $userId;
    }

    public function index()
    {
        $this->check->requirePermission();
        $todoTaskModel = new TaskModel();
        $tasks = $todoTaskModel->getAllTasks($this->userId);
        include './app/views/todo/tasks/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategories();
        include './app/views/todo/tasks/create.php';
    }

    public function store()
    {

        $this->check->requirePermission();
        if (isset($_POST['title']) and isset($_POST['finish_date']) and isset($_POST['category_id']) and isset($_POST['description'])) {
            $data['title'] = trim($_POST['title']);
            $data['description'] = trim($_POST['description']);
            $data['finish_date'] = trim($_POST['finish_date']);
            $data['category_id'] = trim($_POST['category_id']);
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
            $data['status'] = 'new';
            $data['priority'] = 'low';
            $errors = [0 => [], 1 => [], 2 => []];
            if (strlen($data['title']) <= 0) {
                $errors[0]['title'] = 'Название обязательно!';
            }
            if (strlen($data['finish_date']) <= 0) {
                $errors[1]['finish_date'] = 'Дата обязательна!';
            }
            if (strlen($data['description']) <= 0) {
                $errors[2]['description'] = 'Описание обязательно!';
            }
            if (!empty($errors[0]) or !empty($errors[1]) or !empty($errors[2])) {
                print_r(json_encode($errors));
            } else {
                print_r(json_encode('ok'));
                $taskModel = new TaskModel();
                $taskModel->createTask($data);
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