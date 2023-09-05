<?php

namespace models\roles;

use models\Database;

class RoleModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        try {
            $this->db->query("SELECT 1 FROM `roles` LIMIT 1");
        } catch (\PDOException $exception) {
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
        $basicUserRole ="INSERT INTO `roles`(`role_name`, `role_description`) VALUES ('NOT_admin','BasicUserRoleDescription')";
        $admin ="INSERT INTO `roles`(`role_name`, `role_description`) VALUES ('admin','admin')";
        try {
            $this->db->exec($roleTableQuery);
            $this->db->exec($basicUserRole);
            $this->db->exec($admin);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getAllRoles()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM roles");
            $roles = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $roles[] = $row;
            }
            return $roles;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function getRoleById($id)
    {
        try {
            $query = "SELECT * FROM roles WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result ? $result : false;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function createRole($roleName, $roleDescription)
    {
        try {
            $query = "INSERT INTO roles (role_name, role_description) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$roleName, $roleDescription]);
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function updateRole($roleName, $roleDescription, $id)
    {
        $query = "UPDATE roles SET role_name=?, role_description=? WHERE id=?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$roleName, $roleDescription, $id,]);
            return true;
        } catch (\PDOException $exception) {
            print_r($exception->getMessage());
            return false;
        }
    }

    public function deleteRole($id)
    {
        try {
            $query = "DELETE FROM roles WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $exception) {
            $exception->getMessage();
            return false;
        }
    }

}