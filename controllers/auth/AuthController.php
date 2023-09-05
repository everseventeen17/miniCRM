<?php

namespace controllers\auth;

use models\AuthUserModel;
use models\Check;
use models\UserModel;


class AuthController
{
    public function register()
    {
        include './app/views/users/register.php';
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

    public function login()
    {
        include './app/views/users/login.php';
    }

    public function auth()
    {
        $authModel = new AuthUserModel;
        if (isset($_POST['email']) and isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $rememberMe = isset($_POST['remember_me']) ? $_POST['remember_me'] = 'on' : '';
            $user = $authModel->findByEmail($email);
            $errors = [0 => [], 1 => []];
            if (!$user) {
                $errors[0]['email'] = 'Неверное имя пользователя или пароль!';
            }
            if (!password_verify($password, $user['password'])) {
                $errors[1]['password'] = 'Неверное имя пользователя или пароль!';
            }
            if (!empty($errors[0]) or !empty($errors[1])) {
                print_r(json_encode($errors));
            } else {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                if ($rememberMe === 'on') {
                    setcookie('user_email', $email, time() + (7 * 24 * 60 * 60), '/');
                    setcookie('user_name', $user['username'], time() + (7 * 24 * 60 * 60), '/');
                    setcookie('user_password', $password, time() + (7 * 24 * 60 * 60), '/');
                }
                print_r(json_encode('ok'));
            }
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
    }
}