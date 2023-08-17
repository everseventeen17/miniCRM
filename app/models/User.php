<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `login` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }


    public function getAllUsers()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM users");
            $users = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
            return $users;
        } catch (PDOException $exception) {
            echo "<pre>";
            print_r($exception->getMessage());
            echo "</pre>";
            return false;
        }
    }

    public function createUser($data)
    {
        $login = $data['login'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $isAdmin = (int)$data['is_admin'];
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (login, password, is_admin, created_at) VALUE (?,?,?,?)";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $password, $isAdmin, $created_at]);
            return true;
        } catch (PDOException $exception) {
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
        $login = $data['login'];
        $isAdmin = (int)$data['is_admin'];
        $query = "UPDATE users SET login=?, is_admin=? WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $isAdmin, $id,]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

}