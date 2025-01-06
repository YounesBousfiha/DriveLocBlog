<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Model\Categorie;
use Younes\DriveLoc\Helpers\Helpers;


require_once __DIR__ . '/../../../vendor/autoload.php';
$db = DBConnection::getConnection()->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $admin = new AdminController($db);
        $categorie = new Categorie($_POST);

        $status = $admin->createCategorie((array) $categorie);
        Helpers::redirect("http://localhost:63342/DriveLoc/pages/gestionCategorie.php");
}