<?php

namespace models\pages;

use models\Database;

class PageModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $this->db->query("SELECT 1 FROM `pages` LIMIT 1");
        } catch (\PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $pagesTableQuery = "CREATE TABLE IF NOT EXISTS `pages` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `page_name` VARCHAR(255) NOT NULL,
    `page_url` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
        try {
            $this->db->exec($pagesTableQuery);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getAllPages()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM pages");
            $pages = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $pages[] = $row;
            }
            return $pages;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function getPageById($id)
    {
        try {
            $query = "SELECT * FROM pages WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function createPage($pageName, $pageUrl)
    {
        try {
            $query = "INSERT INTO pages (page_name, page_url) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$pageName, $pageUrl]);
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function updatePage($PageName, $pageUrl, $id)
    {
        $query = "UPDATE pages SET page_name=?, page_url=? WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$pageUrl, $pageUrl, $id,]);
            return true;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function deletePage($id)
    {
        try {
            $query = "DELETE FROM pages WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            $exception->getMessage();
            return false;
        }
    }

}