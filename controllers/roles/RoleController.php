<?php

namespace controllers\roles;

use models\roles\RoleModel;
use models\Check;

class RoleController
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
        $roleModel = new RoleModel();
        $roles = $roleModel->getAllRoles();
        include './app/views/roles/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        include './app/views/roles/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
        $roleModel = new RoleModel();
        $roles = $roleModel->getAllRoles();
        if (isset($_POST['role_name']) and isset($_POST['role_description'])) {
            $roleName = trim($_POST['role_name']);
            $roleDescription = trim($_POST['role_description']);
            $errors = [0 => [], 1 => []];
            foreach ($roles as $role) {
                if ($role['role_name'] === $roleName) {
                    $errors[0]['role_name'] = 'Такая роль уже существует!';
                }
            }
            if (strlen($roleName) <= 0) {
                $errors[0]['role_name'] = 'Имя роли обязательно!';
            }
            if (strlen($roleDescription) <= 0) {
                $errors[1]['role_description'] = 'Описание роли обязательно!';
            }
            if (!empty($errors[0]) or !empty($errors[1])) {
                print_r(json_encode($errors));
            } else {
                print_r(json_encode('ok'));
                $roleModel->createRole($roleName, $roleDescription);
            }
        }
    }

    public function delete()
    {
        $this->check->requirePermission();
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $roleModel = new RoleModel();
        if ($roleModel->deleteRole($url[3])) {
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
        $roleModel = new RoleModel();
        $role = $roleModel->getRoleById($url[3]);
        if (!$role) {
            echo "models\roles\RoleModel not fount";
            return;
        }
        include './app/views/roles/edit.php';
    }

    public function update()
    {
        $this->check->requirePermission();
        $roleModel = new RoleModel();
        if (isset($_POST['role_name']) and isset($_POST['role_description']) and isset($_POST['id'])) {
            $roleName = trim($_POST['role_name']);
            $roleDescription = trim($_POST['role_description']);
            $id = $_POST['id'];
            $errors = [0 => [], 1 => []];
            if (empty($roleName)) {
                $errors[0]['role_name'] = 'Введите название роли';
            }
            if (empty($roleDescription)) {
                $errors[1]['role_description'] = 'Введите описание роли!';
            }
            if (empty($id)) {
                $errors[1]['role_name'] = 'Выберете роль';
            }
            if (!empty($errors[0]) or !empty($errors[1])) {
                print_r(json_encode($errors));
                return;
            } else {
                print_r(json_encode('ok'));
                $role = $roleModel->updateRole($roleName, $roleDescription, $id);
            }
        }
    }
}