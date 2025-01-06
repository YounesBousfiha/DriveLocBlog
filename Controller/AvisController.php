<?php

namespace Younes\DriveLoc\Controller;

trait AvisController
{
    private $db;
    private $tableAvis = "avis";

    public function createAvis($instanceAvis)
    {
        $columns = implode(",", array_keys(get_object_vars($instanceAvis)));
        $placeholders = ":" . implode(", :", array_keys(get_object_vars($instanceAvis)));
        $sql = "INSERT INTO {$this->tableAvis} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($instanceAvis as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }

    public function updateAvis($id, $avis_rating)
    {
        $query = "UPDATE $this->tableAvis SET avis_rating = :avis_rating WHERE avis_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':avis_rating', $avis_rating);
        $stmt->execute();
    }

    public function deleteAvis($id)
    {
        $query = "UPDATE $this->tableAvis SET is_deleted = 1 WHERE avis_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllAvis()
    {
        $sql = "SELECT * FROM {$this->tableAvis} WHERE is_deleted = 0";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getAvisForAdmin() {
        $sql = "SELECT * FROM AvisForAdmin";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getAvisByVehicule($vehicule_id) {
        $sql = "SELECT * FROM AvisForVehicule WHERE fk_vehicule_id = :vehicule_id AND is_deleted = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':vehicule_id', $vehicule_id);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

}