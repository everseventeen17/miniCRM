<?php

namespace controllers\users;
use models\Check;
use models\roles\RoleModel;
use models\user\UserModel;
use Carbon\Carbon;

class UserController
{
    private $check;
    private $userId;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $this->userId = $userId;
    }
    public function index()
    {
        $this->check->requirePermission();
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        include './app/views/users/index.php';
    }
    public function profile()
    {
        $this->check->requirePermission();
        $userModel = new UserModel();
        $rolesModel = new RoleModel();
        $role = $rolesModel->getRoleById($this->userId);
        $user = $userModel->getUserById($this->userId);

        $otpLastStr = $userModel->getLastOtpCodeByUserId($this->userId);
        if($otpLastStr){
            $otpCreated = new \DateTime($otpLastStr['created_at']);
            $nowTime = new \DateTime();
            $timeDifference = convertDateToMinutes(Carbon::parse($otpCreated)->diff($nowTime)->format('%Y-%m-%d %H:%i:%s'));
         if(floor($timeDifference) > 60){
             $otp = generateOTP();
             $visible = true;
         }else{
             $visible = false;
             $otp = $otpLastStr['otp_code'];
         }
        }else{
            $visible = true;
            $otp = generateOTP();
        }
        include './app/views/users/profile.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        include './app/views/users/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
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
        $this->check->requirePermission();
        $userModel = new UserModel();
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        if ($userModel->deleteUser($url[3])) {
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
        $userModel = new UserModel();
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $userModel = new UserModel();
        $user = $userModel->getUserById($url[3]);
        include './app/views/users/edit.php';
    }

    public function update()
    {
        $this->check->requirePermission();
        $userModel = new UserModel();
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $userModel = new UserModel();
        $user = $userModel->updateUserData($url[3], $_POST);
        if($user){
            print_r(json_encode('ok'));
        }else{
            return;
        }
    }

    public function otpstore()
    {
        $this->check->requirePermission();
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        if (isset($_POST['otp']) and isset($_POST['user_id'])) {
            $errors = [0 => [], 1 => []];
            if (strlen($_POST['otp']) < 1) {
                $errors[0]['otp'] = 'Неверная длинна otp кода';
            }
            if (!empty($errors[0])) {
                print_r(json_encode($errors));
            } else {
                print_r(json_encode('ok'));
                $data = [
                    'otp' => $_POST['otp'],
                    'user_id' => $_POST['user_id'],
                ];
                $userModel = new UserModel();
                $userModel->writeOtpCodeByUserId($data);
            }
        }
    }

}