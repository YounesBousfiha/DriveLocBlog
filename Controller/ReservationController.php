<?php

namespace Younes\DriveLoc\Controller;

trait ReservationController
{
    private $db;
    private $tableReservation = 'reservation';

    public function approuverReservation($id)
    {
        $query = "UPDATE $this->tableReservation SET reservation_status = 'Approuve' WHERE reservation_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function rejectReservation($id)
    {
        $query = "UPDATE $this->tableReservation SET reservation_status = 'Reject' WHERE reservation_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function createReservation($data)
    {
        $sql = "CALL AjouterReservation(:reservation_date, :reservation_lieux, :fk_user_id, :fk_vehicule_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':reservation_date', $data->reservation_date);
            $stmt->bindParam(':reservation_lieux', $data->reservation_lieux);
            $stmt->bindParam(':fk_user_id', $data->fk_user_id);
            $stmt->bindParam(':fk_vehicule_id', $data->fk_vehicule_id);
            return $stmt->execute();
    }

    public function getAllReservations()
    {
        $sql = "SELECT * FROM {$this->tableReservation}";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getReservationForUser($user_id) {
        $sql = "SELECT * FROM ReservationForUser WHERE fk_user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function getReservationForAdmin() {
        $sql = "SELECT * FROM ReservationForAdmin";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    public function CheckEligibleForAvis($vehicule_id, $user_id) {
        $sql = "SELECT * FROM {$this->tableReservation} WHERE fk_vehicule_id = :vehicule_id AND fk_user_id = :user_id AND reservation_status = 'Approuve'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':vehicule_id', $vehicule_id);
        $stmt->bindParam(':user_id', $user_id);
        if($stmt->execute()) {
            return $stmt->fetch();
        } else {
            return null;
        }
    }

}