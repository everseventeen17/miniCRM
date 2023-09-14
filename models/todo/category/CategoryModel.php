<?php

namespace models\todo\category;

use models\Database;

class CategoryModel
{
    private $db;
    private $userId;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        try {
            $this->db->query("SELECT 1 FROM `todo_category` LIMIT 1");
        } catch (\PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $todoCategoryTableQuery = "CREATE TABLE IF NOT EXISTS `todo_category` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `usability` TINYINT DEFAULT 1,
    `user` INT NOT NULL,
    FOREIGN KEY (user) REFERENCES users(id) ON DELETE CASCADE
    )";
        $startCategory ="INSERT INTO todo_category (title, description, user) VALUES ('startCategory','It is just start category','2')";
        try {
            $this->db->exec($todoCategoryTableQuery);
            $this->db->exec($startCategory);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getAllCategories()
    {
        try{
            $query = "SELECT * FROM todo_category WHERE user=?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->userId]);
            $todo_categories = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $todo_categories[] = $row;
            }
            return $todo_categories;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function getTodoCategoryById($id)
    {
        try {
            $query = "SELECT * FROM todo_category WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function createTodoCategory($title, $description, $user_id)
    {
        try {
            $query = "INSERT INTO todo_category (title, description, user) VALUES (?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $user_id]);
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