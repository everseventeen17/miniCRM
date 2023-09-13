<?php

namespace controllers\home;
use models\pages\PageModel;
use models\roles\RoleModel;
use models\todo\category\CategoryModel;
use models\todo\tasks\TagsModel;
use models\todo\tasks\TaskModel;
use models\user\UserModel;

class HomeController
{
    private $userId;
    public function __construct()
    {
        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public function index()
    {
        $pageModel = new PageModel();
        $rolesModel = new RoleModel();
        $userModel = new UserModel();
        $todoCategoriesModel = new CategoryModel();
        $taskModel= new TaskModel();
        $tagsModel = new TagsModel();

        $path = '/todo/tasks/edit/';
        $taskModel = new TaskModel();
        $tasks = $taskModel->getTodoTaskByUserId($this->userId);
        $tasksJson = json_encode($tasks);

        include './app/views/index.php';
    }
}