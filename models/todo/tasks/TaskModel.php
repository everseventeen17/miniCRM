<?php

namespace models\todo\tasks;

use models\Database;

class TaskModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $this->db->query("SELECT 1 FROM `todo_list` LIMIT 1");
        } catch (\PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $todoListTableQuery = "CREATE TABLE IF NOT EXISTS `todo_list` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `category_id` INT NOT NULL,
    `status` ENUM('new', 'in_progress', 'completed', 'hold', 'cancelled'),
    `priority` ENUM('low', 'medium', 'high', 'urgent'),
    `assigned_to` INT,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `finish_date` DATETIME,
    `completed_at` DATETIME,
    `reminder_at` DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES todo_category(id),
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
    )";
        try {
            $this->db->exec($todoListTableQuery);
            return true;
        } catch (\PDOException $exception) {
            echo "<pre>";
            print_r($exception->getMessage());
            echo "</pre>";
            return false;
        }
    }

    public function getAllTasks($user_id)
    {
        try {
            $query = "SELECT * FROM todo_list WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id]);
            $todo_list = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $todo_list[] = $row;
            }
            return $todo_list;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function getTodoCategoryById($id)
    {
        try {
            $query = "SELECT * FROM todo_list WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function createTask($data)
    {
        try {
            $query = "INSERT INTO todo_list (user_id, title, description, category_id, status, priority, finish_date) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$data['user_id'],$data['title'], $data['description'], $data['category_id'],$data['status'],$data['priority'],$data['finish_date']]);
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function updateTodoCategory($title, $description, $usability, $id)
    {
        $query = "UPDATE todo_category SET title=?, description=?, usability=? WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $usability, $id,]);
            return true;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function deleteTodoCategory($id)
    {
        try {
            $query = "DELETE FROM todo_category WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            $exception->getMessage();
            return false;
        }
    }

}