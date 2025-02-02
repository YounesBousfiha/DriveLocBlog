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
        $query = "DELETE FROM $this->tableFavori WHERE favoris_id = :id";
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
        $sql = "SELECT F.favoris_id, A.article_id, A.article_title, A.article_content, A.article_image  FROM {$this->tableFavori} F JOIN articles A ON F.fk_article_id = A.article_id WHERE F.fk_user_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function exists($fk_user_id, $fk_article_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM favoris WHERE fk_user_id = :fk_user_id AND fk_article_id = :fk_article_id");
        $stmt->bindValue(':fk_user_id', $fk_user_id);
        $stmt->bindValue(':fk_article_id', $fk_article_id);
        if($stmt->execute()) {
            return $stmt->fetchColumn() > 0;
        } else {
            return false;
        }
    }

}