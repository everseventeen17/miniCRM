<?php
require_once './app/models/User.php';

class UserController
{

    public function index()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        include './app/views/users/index.php';
    }

    public function create()
    {
        include './app/views/users/create.php';
    }

    public function store()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();

        if (isset($_POST['login']) and isset($_POST['password']) and isset($_POST['confirm_password']) and isset($_POST['is_admin'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $errors = [];
            if ($password !== $confirm_password) {
                $errors[] = 'Пароли не совпадают';
            }
            if (strlen($password) < 3) {
                $errors[] = 'Длинна пароля должна быть не меньше 3 символов';
            }
            if (strlen($_POST['login']) > 25) {
                $errors[] = 'Логин должен быть короче 25 символов';
            }
            if (!preg_match("/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u", $_POST['login'])) {
                $errors[] = 'Формат ввода email не верен!';
            }
            foreach ($users as $user) {
                if ($user['login'] === $_POST['login']) {
                    $errors[] = 'Пользователь с данным логином уже существует!';
                }
            }
            if (count($errors) !== 0) {
                echo "<pre>";
                print_r($errors);
                echo "</pre>";
                return;
            } else {
                echo 'ok';
                $userModel = new User();
                $userModel->createUser($_POST);
            }
        }
    }

    public function delete()
    {
        $userModel = new User();
        if ($userModel->deleteUser($_GET['id'])) {
            echo 1;
            return;
        } else {
            echo 0;
            return;
        }
    }

    public function edit(){
        $userModel = new User();
        $user = $userModel->getUserById($_GET['id']);
        include './app/views/users/edit.php';
    }
    public function update(){
        $userModel = new User();
        $user = $userModel->updateUserData($_GET['id'], $_POST);
        header('Location: /index.php?page=users');
    }

}