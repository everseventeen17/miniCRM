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

        if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $errors = [];
            if ($password !== $confirm_password) {
                $errors[] = 'Пароли не совпадают';
            }
            if (strlen($password) < 3) {
                $errors[] = 'Длинна пароля должна быть не меньше 3 символов';
            }
            if (strlen($_POST['email']) > 50) {
                $errors[] = 'Email должен быть короче 50 символов';
            }
            if (!preg_match("/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u", $_POST['email'])) {
                $errors[] = 'Формат ввода email не верен!';
            }
            if (strlen($_POST['username']) <= 3 ) {
                $errors[] = 'Имя пользователя должно быть не меньше 3-ех символов!';
            }
            foreach ($users as $user) {
                if ($user['email'] === $_POST['email']) {
                    $errors[] = 'Пользователь с данным email уже существует!';
                }
            }
            if (count($errors) !== 0) {
                echo "<pre>";
                print_r($errors);
                echo "</pre>";
                return;
            } else {
                echo 'ok';
                $data = [
                    'username'=> $_POST['username'],
                    'email'=> $_POST['email'],
                    'password'=> $_POST['password'],
                    'role'=> 1,
                ];
                $userModel = new User();
                $userModel->createUser($data);
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
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $userModel = new User();
        $user = $userModel->updateUserData($_GET['id'], $_POST);
        die();
        header('Location: /index.php?page=users');
    }

}