<?php

namespace Younes\DriveLoc\Controller;

trait ThemeController
{
    private $db;
    private $tableTheme = "themes";
    public function createTheme($instanceTheme)
    {
        $columns = implode(",", array_keys(get_object_vars($instanceTheme)));
        $placeholders = ":" . implode(", :", array_keys(get_object_vars($instanceTheme)));
        $sql = "INSERT INTO {$this->tableTheme} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($instanceTheme as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public function updateTheme($id, $theme_name)
    {
        $query = "UPDATE $this->tableTheme SET theme_name = :theme_name WHERE theme_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':theme_name', $theme_name);
        $stmt->execute();
    }

    public function deleteTheme($id)
    {
        $query = "delete from $this->tableTheme WHERE theme_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllThemes()
    {
        $sql = "SELECT * FROM {$this->tableTheme}";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }
}