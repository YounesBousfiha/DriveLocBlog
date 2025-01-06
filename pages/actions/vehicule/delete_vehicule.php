<?php

use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Helpers\Helpers;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;
$admin = new AdminController($db);

if($_SERVER['REQUEST_METHOD'] === 'GET') {

    $admin->deleteVehicule($_GET['id']);

    Helpers::redirect("http://localhost:63342/DriveLoc/pages/gestionVoitures.php");
}
