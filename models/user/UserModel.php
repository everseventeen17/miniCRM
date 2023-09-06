<?php

namespace models\user;

use models\Database;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $this->db->query("SELECT 1 FROM `roles` LIMIT 1");
            $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (\PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable()
    {
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
        $basicUser ="INSERT INTO `users`(`username`, `email`, `password`, `role`) VALUES ('test','test@mail.com', '$2y$10$3Af2IWDFzl.uc9nSyc3mi.7YOkhpmGYloW1UNzgebX9Pq.Lrw6d8C', '1')";
        $admin ="INSERT INTO `users`(`username`, `email`, `password`, `role`) VALUES ('admin','admin@mail.com', '$2y$10$3Af2IWDFzl.uc9nSyc3mi.7YOkhpmGYloW1UNzgebX9Pq.Lrw6d8C', '2')";
        try {
            $this->db->exec($userTableQuery);
            $this->db->exec($basicUser);
            $this->db->exec($admin);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }


    public function getAllUsers()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM users");
            $users = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
            return $users;
        } catch (\PDOException $exception) {
            echo "<pre>";
            print_r($exception->getMessage());
            echo "</pre>";
            return false;
        }
    }

    public function createUser($data)
    {
        $username = $data['username'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = $data['role'];
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (username, email, password, role, created_at) VALUE (?,?,?,?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, $password, $role, $created_at]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $exception) {
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
        $query = "UPDATE users SET username=?, email=?, is_admin=?, role=?, is_active=? WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, $isAdmin, $role, $isActive, $id,]);
            return true;
        } catch (\PDOException $exception) {
            echo "<pre>";
            print_r($exception->getMessage());
            echo "</pre>";
            return false;
        }
    }

}