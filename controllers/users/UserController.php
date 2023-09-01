<?php

namespace controllers\users;
use models\UserModel;

class UserController
{

    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        include './app/views/users/index.php';
    }

    public function create()
    {
        include './app/views/users/create.php';
    }

    public function store()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();

        if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $errors = [0 => [], 1 => [], 2 => [], 3 => []];
            if ($password !== $confirm_password) {
                $errors[3]['confirm_password'] = 'Пароли не совпадают';
            }
            if (strlen($password) < 3) {
                $errors[2]['password'] = 'Длинна пароля должна быть не меньше 3 символов';
            }
            if (strlen($_POST['email']) > 50) {
                $errors[1]['email'] = 'Email должен быть короче 50 символов';
            }
            if (!preg_match("/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u", $_POST['email'])) {
                $errors[1]['email'] = 'Формат ввода email не верен!';
            }
            if (strlen($_POST['username']) <= 3) {
                $errors[0]['username'] = 'Имя пользователя должно быть не меньше 3-ех символов!';
            }
            foreach ($users as $user) {
                if ($user['email'] === $_POST['email']) {
                    $errors[1]['email'] = 'Пользователь с данным email уже существует!';
                }
            }
            if (!empty($errors[0]) or !empty($errors[1]) or !empty($errors[2]) or !empty($errors[3])) {
                print_r(json_encode($errors));
            } else {
                print_r(json_encode('ok'));
                $data = [
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'role' => 1,
                ];
                $userModel = new UserModel();
                $userModel->createUser($data);
            }
        }
    }

    public function delete()
    {
        $userModel = new UserModel();
        if ($userModel->deleteUser($_GET['id'])) {
            echo 1;
            return;
        } else {
            echo 0;
            return;
        }
    }

    public function edit()
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById($_GET['id']);
        include './app/views/users/edit.php';
    }

    public function update()
    {
        $userModel = new UserModel();
        $user = $userModel->updateUserData($_GET['id'], $_POST);
        header('Location: /index.php?page=users');
    }

}