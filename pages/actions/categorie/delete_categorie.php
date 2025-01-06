<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Helpers;


require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$admin = new AdminController($db);

$categorieData = $admin->getCategorie($_GET['id']);


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $status = $admin->deleteCategorie($_GET['id']);
    Helpers::redirect("http://localhost:63342/DriveLoc/pages/gestionCategorie.php");

}
