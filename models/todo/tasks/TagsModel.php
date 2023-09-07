<?php

namespace models\todo\tasks;

use models\Database;

class TagsModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $this->db->query("SELECT 1 FROM `tags` LIMIT 1");
        } catch (\PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $tags = "CREATE TABLE IF NOT EXISTS `tags` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `name` VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id));

    CREATE TABLE IF NOT EXISTS `task_tags` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `task_id` INT(11) NOT NULL,
    `tag_id` INT(11) NOT NULL,
    FOREIGN KEY (task_id) REFERENCES todo_list(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
        )";
        try {
            $this->db->exec($tags);
            return true;
        } catch (\PDOException $exception) {
            echo "<pre>";
            print_r($exception->getMessage());
            echo "</pre>";
            return false;
        }
    }
    public function getTagsByTaskId($task_id)
    {
        try {
            $query = "SELECT * FROM tags JOIN task_tags ON tags.id = task_tags.tag_id WHERE task_tags.task_id = :task_id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['task_id' => $task_id]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }


}