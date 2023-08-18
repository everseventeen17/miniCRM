<?php

class AuthUser
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $this->db->query("SELECT 1 FROM `roles` LIMIT 1");
            $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `roles` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `role_name` VARCHAR(255) NOT NULL,
    `role_description` TEXT
    )";
        $userTableQuery = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
    `password` VARCHAR(255) NOT NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
    `role` INT(11) NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `last_login` TIMESTAMP NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`role`) REFERENCES `roles`(`id`)
    )";
        try {
            $this->db->exec($roleTableQuery);
            $this->db->exec($userTableQuery);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }


    public function registerUser($username, $email, $password)
    {
        $created_at = date('Y-m-d H:i:s');
        $query = "INSERT INTO users (username, email, password, created_at) VALUES (?,?,?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $created_at]);
        } catch (PDOException $exception) {
            echo "<pre>";
            print_r($exception->getMessage());
            echo "</pre>";
            return false;
        }
    }

    public function loginUser ($email, $password)
    {
        try {
            $query = "SELECT FROM users WHERE email = ? LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user and password_verify($password, $user['password'])) {
                return $user;
            }else{
                return false;
            }
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function findByEmail($email)
    {
        try {
            $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ? $user : false;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function updateUserData($id, $data)
    {
        $username = $data['username'];
        $email = $data['email'];
        $role = $data['role'];
        $isActive = isset($data['is_active']) ? 1 : 0;
        $isAdmin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;

        echo "<pre>";
        print_r($isAdmin);
        echo "</pre>";

        $query = "UPDATE users SET username=?, email=?, is_admin=?, role=?, is_active=? WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, $isAdmin, $role, $isActive, $id,]);
            return true;
        } catch (PDOException $exception) {
            echo "<pre>";
            print_r($exception->getMessage());
            echo "</pre>";
            return false;
        }
    }
}