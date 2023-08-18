<?php

require_once 'app/models/AuthUser.php';

class AuthController
{
    public function register()
    {
        include './app/views/users/register.php';
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
            if (strlen($_POST['username']) <= 3) {
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
            } else {
                echo 'ok';
                $data = [
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'role' => 1,
                ];
                $userModel = new User();
                $userModel->createUser($data);
            }
        }
    }

    public function login()
    {
        include './app/views/users/login.php';
    }

    public function auth()
    {
        $authModel = new AuthUser;
        if (isset($_POST['email']) and isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $rememberMe = isset($_POST['remember_me']) ? $_POST['remember_me'] = 'on' : '';
            $user = $authModel->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                if($rememberMe === 'on'){
                    setcookie('user_email', $email, time() + (7*24*60*60), '/');
                    setcookie('user_password', $password, time() + (7*24*60*60), '/');
                }
                echo 'ok';
            } else {
                echo "Invalid email or password";
            }

        }
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /index.php?page=users');
    }
}