<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Helpers;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$admin = new AdminController($db);

$allReservations = $admin->getAllReservations();

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $admin->rejectReservation($id);
        Helpers::redirect("http://localhost:63342/DriveLoc/pages/gestionReservation.php");
    }
}



