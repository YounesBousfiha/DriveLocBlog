<?php

namespace Younes\DriveLoc\Controller;

trait CommentaireController
{
    private $db;
    private $tableCommentaire = "commentaires";

    public function createCommentaire($instanceCommentaire)
    {
        $columns = implode(",", array_keys(get_object_vars($instanceCommentaire)));
        $placeholders = ":" . implode(", :", array_keys(get_object_vars($instanceCommentaire)));
        $sql = "INSERT INTO {$this->tableCommentaire} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($instanceCommentaire as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public function updateCommentaire($id, $commentaire_content)
    {
        $query = "UPDATE $this->tableCommentaire SET commentaire_content = :commentaire_content WHERE commentaire_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':commentaire_content', $commentaire_content);
        $stmt->execute();
    }

    public function deleteCommentaire($id)
    {
        $query = "DELETE FROM $this->tableCommentaire WHERE commentaire_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllCommentaires()
    {
        $sql = "SELECT * FROM {$this->tableCommentaire}";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getCommentaireForAdmin() {
        $sql = "SELECT * FROM CommentaireForAdmin";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

}