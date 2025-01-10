<?php

namespace Younes\DriveLoc\Controller;

trait FavoriController
{
    private $db;
    private $tableFavori = "favoris";

    public function addToFavoris($instanceFavori)
    {
        $columns = implode(",", array_keys(get_object_vars($instanceFavori)));
        $placeholders = ":" . implode(", :", array_keys(get_object_vars($instanceFavori)));
        $sql = "INSERT INTO {$this->tableFavori} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($instanceFavori as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public function deleteFromFavoris($id)
    {
        $query = "DELETE FROM $this->tableFavori WHERE favori_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getFavoris($id)
    {
        $sql = "SELECT * FROM {$this->tableFavori} WHERE fk_user_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

}