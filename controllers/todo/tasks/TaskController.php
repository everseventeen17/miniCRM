<?php

namespace controllers\todo\tasks;

use models\todo\tasks\TagsModel;
use models\todo\tasks\TaskModel;
use models\todo\category\CategoryModel;
use models\Check;
use models\user\UserModel;
use Carbon\Carbon;

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
        $categoryModel = new CategoryModel();
        $userModel = new UserModel();
        $tasks = $todoTaskModel->getAllTasks();
        usort($tasks, function ($a, $b) {
            return ($a['status_filter'] - $b['status_filter']);
        });
        foreach ($tasks as $key => $value) {
            $category = $categoryModel->getTodoCategoryById($tasks[$key]['category_id']);
            $userWhoSet = $userModel->getUserById($tasks[$key]['user_id']);
            $userWhomDelivered = $userModel->getUserById($tasks[$key]['assigned_to']);
            $tasks[$key]['USER_BY_WHO'] = $userWhoSet;
            $tasks[$key]['USER_TO'] = $userWhomDelivered;
            $tasks[$key]['CATEGORY'] = $category;
        }
        include './app/views/todo/tasks/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategories();
        $usersModel = new UserModel();
        $users = $usersModel->getAllUsers();
        include './app/views/todo/tasks/create.php';
    }

    public function store()
    {

        $this->check->requirePermission();
        if (isset($_POST['title']) and isset($_POST['finish_date']) and isset($_POST['category_id']) and isset($_POST['description']) and isset($_POST['assigned_to'])) {
            $data['title'] = trim($_POST['title']);
            $data['description'] = trim($_POST['description']);
            $data['finish_date'] = trim($_POST['finish_date']);
            $data['category_id'] = trim($_POST['category_id']);
            $data['assigned_to'] = trim($_POST['assigned_to']);
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
        $taskModel = new TaskModel();
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        if ($taskModel->deleteTodoTask($url[4])) {
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
        $taskModel = new TaskModel();
        $task = $taskModel->getTodoTaskById($url[4]);
        $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategories();
        $tagsModel = new TagsModel();
        $tags = $tagsModel->getTagsByTaskId($task['id']);
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        if (!$task) {
            echo "task not found";
            return;
        }
        include './app/views/todo/tasks/edit.php';
    }

    public function update()
    {
        $this->check->requirePermission();
        if (isset($_POST['title']) and isset($_POST['user_id']) and isset($_POST['description']) and isset($_POST['assigned_to']) and isset($_POST['category_id']) and isset($_POST['status']) and isset($_POST['priority']) and isset($_POST['finish_date']) and isset($_POST['id'])) {
            $todoTaskModel = new TaskModel();
            $task = $todoTaskModel->getTodoTaskById($_POST['id']);
            $data['title'] = trim($_POST['title']);
            $data['description'] = trim($_POST['description']);
            $data['finish_date'] = trim($_POST['finish_date']);
            $data['category_id'] = trim($_POST['category_id']);
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
            $data['status'] = trim($_POST['status']);
            switch ($data['status']) {
                case 'new':
                    $data['status_filter'] = 2;
                    $data['paused_at'] = null;
                    $data['wasted_time'] = null;
                    $data['started_at'] = null;
                    break;
                case 'in_progress':
                    $data['status_filter'] = 0;
                    $data['paused_at'] = null;
                    $wastedTime = isset($task['wasted_time']) ? $task['wasted_time'] : null;
                    $data['started_at'] = date('Y-m-d H:i:s');
                    break;
                case 'completed':
                    $data['status_filter'] = 3;
                    $data['paused_at'] = date('Y-m-d H:i:s');
                    $wastedTime = isset($task['wasted_time']) ? $task['wasted_time'] : null;
                    $data['started_at'] = isset($task['started_at']) ? $task['started_at'] : null;
                    break;
                case 'hold':
                    $data['status_filter'] = 1;
                    $data['paused_at'] = date('Y-m-d H:i:s');
                    $wastedTime = isset($task['wasted_time']) ? $task['wasted_time'] : null;
                    $data['started_at'] = isset($task['started_at']) ? $task['started_at'] : null;
                    break;
            }
            $nowWastedTime = convertDateToMinutes(Carbon::parse($data['started_at'])->diff($data['paused_at'])->format('%Y-%m-%d %H:%i:%s'));
            $data['wasted_time'] = $nowWastedTime;
            if (isset($wastedTime)) {
                $data['wasted_time'] = $wastedTime + $nowWastedTime;
            }else{
                $data['wasted_time'] = $nowWastedTime;
            }
            $data['priority'] = trim($_POST['priority']);
            $data['assigned_to'] = trim($_POST['assigned_to']);
            $data['id'] = trim($_POST['id']);
//            $reminder_at_option = $data['reminder_at'];
//            $finish_date = new \DateTime($data['finish_date']);
//
//            switch ($reminder_at_option) {
//                case '30_minutes':
//                    $interval = new \DateInterval('PT30M');
//                    break;
//                case '1_hour':
//                    $interval = new \DateInterval('PT1H');
//                    break;
//                case '2_hours':
//                    $interval = new \DateInterval('PT2H');
//                    break;
//                case '12_hours':
//                    $interval = new \DateInterval('PT12H');
//                    break;
//                case '24_hours':
//                    $interval = new \DateInterval('P1D');
//                    break;
//                case '7_days':
//                    $interval = new \DateInterval('P7D');
//                    break;
//            }

            $errors = [0 => [], 1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => []];
//            if (empty($title)) {
//                $errors[0]['title'] = 'Введите название';
//            }
//            if (empty($description)) {
//                $errors[1]['description'] = 'Введите описание!';
//            }
//            if (empty($id)) {
//                $errors[1]['title'] = 'Выберете todoList task';
//            }
            if (!empty($errors[0]) or !empty($errors[1]) or !empty($errors[2]) or !empty($errors[3]) or !empty($errors[4]) or !empty($errors[5]) or !empty($errors[6])) {
                print_r(json_encode($errors));
                return;
            } else {
                print_r(json_encode('ok'));
                $todoTaskModel = new TaskModel();
                $task = $todoTaskModel->updateTodoTask($data);
            }
        }
    }
}