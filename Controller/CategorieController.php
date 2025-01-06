<?php

namespace Younes\DriveLoc\Controller;

trait CategorieController
{
    private $db;
    private $tableCategories = 'categories';

    public function createCategorie($data) {
        $columns = implode(",", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->tableCategories} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value['categorie_nom']);
        }
        return $stmt->execute();
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM {$this->tableCategories}";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getCategorie($id) {
        $sql = "SELECT * FROM {$this->tableCategories} WHERE categorie_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()) {
            return $stmt->fetch();
        } else {
            return null;
        }
    }

    public function updateCategorie($id, $data) {
        $columns = [];
        foreach ($data as $key => $value) {
            $columns[] = "$key = :$key";
        }
        $sql = "UPDATE {$this->tableCategories} SET " . implode(', ', $columns) . " WHERE categorie_id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":id", $id);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public function deleteCategorie($id) {
        $sql = "DELETE FROM {$this->tableCategories} WHERE categorie_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }
}