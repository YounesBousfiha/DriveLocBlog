<?php

namespace Younes\DriveLoc\Controller;

trait Stats
{
    private $db;
    public function getStats()
    {
        $query = "SELECT COUNT(*) as totalReservations FROM reservation";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $totalReservations = $stmt->fetch();


        $query = "SELECT COUNT(*) as totalCars FROM vehicules";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $totalCars = $stmt->fetch();

        $query = "SELECT COUNT(*) as totalAvis FROM avis";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $totalAvis= $stmt->fetch();

        $query = "SELECT COUNT(*) as totalCategories FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $totalCategories = $stmt->fetch();

        return [
            'totalReservations' => $totalReservations['totalReservations'],
            'totalAvis' => $totalAvis['totalAvis'],
            'totalCars' => $totalCars['totalCars'],
            'totalCategories' => $totalCategories['totalCategories']
        ];
    }
}