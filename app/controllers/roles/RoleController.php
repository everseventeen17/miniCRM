<?php
require_once 'app/models/roles/Role.php';

class RoleController
{
    public function index()
    {
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();
        include './app/views/roles/index.php';
    }

    public function create()
    {
        include './app/views/roles/create.php';
    }

    public function store()
    {
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();
        if (isset($_POST['role_name']) and isset($_POST['role_description'])) {
            $roleName = trim($_POST['role_name']);
            $roleDescription = trim($_POST['role_description']);
            $errors = [];
            foreach ($roles as $role) {
                if ($role['role_name'] === $roleName) {
                    $errors[] = 'Такая роль уже существует!';
                }
            }
            if (strlen($roleName) <= 0) {
                $errors[] = 'Имя роли обязательно!';
            }
            if (strlen($roleDescription) <= 0) {
                $errors[] = 'Описание роли обязательно!';
            }

            if (count($errors) !== 0) {
                echo "<pre>";
                print_r($errors);
                echo "</pre>";
                return;
            } else {
                echo 'ok';
                $roleModel->createRole($roleName, $roleDescription);
            }
        }
    }

    public function delete()
    {
        $roleModel = new Role();
        if ($roleModel->deleteRole($_GET['id'])) {
            echo 1;
            return;
        } else {
            echo 0;
            return;
        }
    }

    public function edit()
    {
        $roleModel = new Role();
        $role = $roleModel->getRoleById($_GET['id']);
        if (!$role) {
            echo "Role not fount";
            return;
        }
        include './app/views/roles/edit.php';
    }

    public function update()
    {
        $roleModel = new Role();
        if (isset($_POST['role_name']) and isset($_POST['role_description']) and isset($_POST['id'])) {
            $roleName = trim($_POST['role_name']);
            $roleDescription = trim($_POST['role_description']);
            $id = $_POST['id'];
            $errors = [];
            if (empty($roleName)) {
                $errors[] = "Role name is required";
            }
            if (empty($roleDescription)) {
                $errors[] = "Role description is required";
            }
            if (empty($id)) {
                $errors[] = "You may choose role";
            }
            if (count($errors) !== 0) {
                echo "<pre>";
                print_r($errors);
                echo "</pre>";
                return;
            } else {
                echo 'ok';
                $role = $roleModel->updateRole($roleName, $roleDescription, $id);
            }
        }
//        header('Location: /index.php?page=users');
    }
}