<?php

namespace models\pages;

use models\Database;
use models\roles\RoleModel;

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
    `role` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
        $userPage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('Users','users','2')";
        $usersCreatePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('UsersCreate','users/create','2')";
        $usersEditPage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('UsersEdit','users/edit','2')";
        $usersUpdatePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('UsersUpdate','users/update','2')";
        $usersStorePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('UsersStore','users/store','2')";
        $usersDeletePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('UsersDelete','users/delete','2')";

        $pagesPage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('Pages','pages','2')";
        $pagesCreatePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('PagesCreate','pages/create','2')";
        $pagesUpdatePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('PagesUpdate','pages/update','2')";
        $pagesEditPage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('PagesEdit','pages/edit','2')";
        $pagesStorePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('PagesStore','pages/store','2')";
        $pagesDeletePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('PagesDelete','pages/delete','2')";

        $rolesPage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('Roles','roles','2')";
        $rolesCreatePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('RolesCreate','roles/create','2')";
        $rolesUpdatePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('RolesUpdate','roles/update','2')";
        $rolesEditPage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('RolesEdit','roles/edit','2')";
        $rolesStorePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('RolesStore','roles/store','2')";
        $rolesDeletePage = "INSERT INTO `pages`(`page_name`, `page_url`, `role`) VALUES ('RolesDelete','roles/delete','2')";

        try {
            $this->db->exec($pagesTableQuery);
//users
            $this->db->exec($userPage);
            $this->db->exec($usersCreatePage);
            $this->db->exec($usersUpdatePage);
            $this->db->exec($usersStorePage);
            $this->db->exec($usersDeletePage);
            $this->db->exec($usersEditPage);
//roles
            $this->db->exec($rolesPage);
            $this->db->exec($rolesCreatePage);
            $this->db->exec($rolesUpdatePage);
            $this->db->exec($rolesStorePage);
            $this->db->exec($rolesEditPage);
            $this->db->exec($rolesDeletePage);

//pages
            $this->db->exec($pagesPage);
            $this->db->exec($pagesCreatePage);
            $this->db->exec($pagesUpdatePage);
            $this->db->exec($pagesStorePage);
            $this->db->exec($pagesEditPage);
            $this->db->exec($pagesDeletePage);
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

    public function createPage($pageName, $pageUrl, $roles)
    {
        try {
            $query = "INSERT INTO pages (page_name, page_url, role) VALUES (?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$pageName, $pageUrl, $roles]);
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function updatePage($pageName, $pageUrl, $roles, $id)
    {
        $query = "UPDATE pages SET page_name=?, page_url=?, role=? WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$pageName, $pageUrl, $roles, $id]);
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

    public function getByUrl($url)
    {
        try {
            $query = "SELECT * FROM pages WHERE page_url = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$url]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

}